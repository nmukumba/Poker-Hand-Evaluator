<?php

namespace App\Services;

use App\Models\Hand;

class HandEvaluatorService
{
    /**
     * @var Hand $hand
     */
    protected Hand $hand;

    /**
     * @param Hand $hand
     */
    public function __construct(Hand $hand)
    {
        $this->hand = $hand;
    }

    /**
     * @return string
     */
    public function evaluateHand(): string
    {
        $counts = $this->getRankCounts();
        rsort($counts);
        $maxCount = $counts[0];
        $secondCount = (count($this->getUniqueRankCounts()) > 1) ? $counts[1] : 0;

        switch ($maxCount) {
            case 4:
                return 'Four of a Kind';
            case 3:
                if ($secondCount === 2) {
                    return 'Full House';
                }

                return 'Three of a Kind';
            case 2:
                if ($secondCount === 2) {
                    return 'Two Pairs';
                }

                return 'Pair';
            default:
                if ($this->isRoyalFlush()) {
                    return 'Royal Flush';
                }

                if ($this->isStraightFlush()) {
                    return 'Straight Flush';
                }

                if ($this->isFlush()) {
                    return 'Flush';
                }

                if ($this->isStraight()) {
                    return 'Straight';
                }

                return 'High Card';
        }
    }

    public function isRoyalFlush(): bool
    {
        return $this->isStraightFlush() &&
            array_key_exists('A', $this->hand->getHandRankCount()) &&
            array_key_exists('K', $this->hand->getHandRankCount()) &&
            array_key_exists('Q', $this->hand->getHandRankCount()) &&
            array_key_exists('J', $this->hand->getHandRankCount()) &&
            array_key_exists('10', $this->hand->getHandRankCount());
    }

    public function isStraightFlush(): bool
    {
        return $this->isFlush() && $this->isStraight();
    }

    /**
     * @return bool
     */
    public function isFlush(): bool
    {
        return count($this->hand->getUniqueHandSuits()) === 1;
    }

    /**
     * Returns the highest straight that can be found
     *
     * @return boolean
     */
    public function isStraight(): bool
    {
        $isStraight = false;
        $straightRanks = [
            'A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'
        ];

        for ($i = 0; $i <= 9; $i++) {
            $hasStraight = true;

            for ($j = 0; $j < 5; $j++) {
                if (!array_key_exists($straightRanks[$i + $j], $this->hand->getHandRankCount())) {
                    $hasStraight = false;
                    break;
                }
            }

            if ($hasStraight) {
                $isStraight = true;
                break;
            }
        }

        return $isStraight;
    }

    /**
     * @return array
     */
    protected function getRankCounts(): array
    {
        return array_values($this->hand->getHandRankCount());
    }

    /**
     * @return array
     */
    protected function getUniqueRankCounts(): array
    {
        return array_unique($this->getRankCounts());
    }
}
