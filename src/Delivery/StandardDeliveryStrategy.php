<?php

namespace Acme\WidgetCo\Delivery;

/**
 * Class StandardDeliveryStrategy
 *
 * This class implements a standard delivery cost calculation strategy.
 */
class StandardDeliveryStrategy implements DeliveryStrategyInterface
{
    /**
     * Calculate the delivery cost based on the total cost of the order.
     *
     * Delivery cost rules:
     * - Orders with a total cost of $90 or more have free delivery.
     * - Orders with a total cost between $50 and $89.99 have a delivery cost of $2.95.
     * - Orders with a total cost below $50 have a delivery cost of $4.95.
     *
     * @param float $totalCost The total cost of the order.
     * @return float The calculated delivery cost.
     */
    public function calculateDeliveryCost(float $totalCost): float
    {
        if ($totalCost >= 90) {
            return 0.0;
        } elseif ($totalCost >= 50) {
            return 2.95;
        } else {
            return 4.95;
        }
    }
}
