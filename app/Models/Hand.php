<?php

namespace App\Models;

class Hand
{
    protected array $cards;

    /**
     * @param array $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @param Card[] $cards
     */
    public function setCards(array $cards): void
    {
        $this->cards = $cards;
    }

    /**
     * @param Card $card
     * @return void
     */
    public function addCard(Card $card): void
    {
        $this->cards[] = $card;
    }

    /**
     * @param Card $card
     * @return void
     */
    public function removeCard(Card $card): void
    {
        if (($key = array_search($card, $this->cards, true)) !== FALSE) {
            unset($this->cards[$key]);
        }
    }

    /**
     * @return array
     */
    public function getHandRankCount(): array
    {
        $ranks = [];

        foreach ($this->cards as $card) {
            if (!array_key_exists($card->getRank(), $ranks)) {
                $ranks[$card->getRank()] = 0;
            }

            $ranks[$card->getRank()]++;
        }

        return $ranks;
    }

    /**
     * @return array
     */
    public function getUniqueHandSuits(): array
    {
        $suits = [];
        foreach ($this->cards as $card) {
            if (!in_array($card->getSuit(), $suits, true)) {
                $suits[] = $card->getSuit();
            }
        }

        return $suits;
    }
}
