<?php

namespace Acme\WidgetCo\Offer;

/**
 * Interface for offer application strategies.
 */
interface OfferStrategyInterface
{
    /**
     * Apply offers to the given basket and calculate the total cost after offers.
     *
     * @param array $basket An array representing the items in the basket.
     * @return float The total cost after applying offers.
     */
    public function applyOffers(array $basket): float;
}
