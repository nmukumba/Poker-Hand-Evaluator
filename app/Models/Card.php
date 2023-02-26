<?php

namespace App\Models;

use App\Exceptions\InvalidRankException;
use App\Exceptions\InvalidSuitException;

class Card
{
    protected string $rank;
    protected string $suit;

    protected array $ranks = [
        'A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'
    ];

    protected array $suits = [
        'S',
        'C',
        'D',
        'H'
    ];

    /**
     * @param string $rank
     * @param string $suit
     * @throws InvalidRankException
     * @throws InvalidSuitException
     */
    public function __construct(string $rank, string $suit)
    {
        if (!$this->isValidRank($rank)) {
            throw new InvalidRankException("An invalid rank was set for a card: $rank");
        }

        if (!$this->isValidSuit($suit)) {
            throw new InvalidSuitException("An invalid suit was set for a card: $suit");
        }
        $this->rank = $rank;
        $this->suit = $suit;
    }

    /**
     * @return string
     */
    public function getRank(): string
    {
        return $this->rank;
    }

    /**
     * @param string $rank
     */
    public function setRank(string $rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @return string
     */
    public function getSuit(): string
    {
        return $this->suit;
    }

    /**
     * @param string $suit
     */
    public function setSuit(string $suit): void
    {
        $this->suit = $suit;
    }

    /**
     * @param string $rank
     * @return bool
     */
    public function isValidRank(string $rank): bool
    {
        return in_array($rank, $this->ranks, true);
    }

    /**
     * @param string $suit
     * @return bool
     */
    protected function isValidSuit(string $suit): bool
    {
        return in_array($suit, $this->suits, true);
    }
}
