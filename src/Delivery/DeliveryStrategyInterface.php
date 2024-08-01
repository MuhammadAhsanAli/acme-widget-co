<?php

namespace Acme\WidgetCo\Delivery;

/**
 * Interface for delivery cost calculation strategies.
 */
interface DeliveryStrategyInterface
{
    /**
     * Calculate the delivery cost based on the total cost of the order.
     *
     * @param float $totalCost The total cost of the order.
     * @return float The calculated delivery cost.
     */
    public function calculateDeliveryCost(float $totalCost): float;
}
