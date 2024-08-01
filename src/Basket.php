<?php

namespace Acme\WidgetCo;

use Acme\WidgetCo\Delivery\DeliveryStrategyInterface;
use Acme\WidgetCo\Offer\OfferStrategyInterface;

/**
 * Class Basket
 *
 * This class represents a shopping basket, applying product offers and calculating delivery costs.
 */
class Basket
{
    /**
     * @var ProductCatalogue The product catalogue used to get product prices.
     */
    private ProductCatalogue $catalogue;

    /**
     * @var DeliveryStrategyInterface The delivery strategy used to calculate delivery costs.
     */
    private DeliveryStrategyInterface $deliveryStrategy;

    /**
     * @var OfferStrategyInterface The offer strategy used to apply offers to the basket.
     */
    private OfferStrategyInterface $offerStrategy;

    /**
     * @var array An array representing the items in the basket.
     */
    private array $basket = [];

    /**
     * Basket constructor.
     *
     * @param ProductCatalogue $catalogue The product catalogue instance.
     * @param DeliveryStrategyInterface $deliveryStrategy The delivery strategy instance.
     * @param OfferStrategyInterface $offerStrategy The offer strategy instance.
     */
    public function __construct(
        ProductCatalogue $catalogue,
        DeliveryStrategyInterface $deliveryStrategy,
        OfferStrategyInterface $offerStrategy
    ) {
        $this->catalogue = $catalogue;
        $this->deliveryStrategy = $deliveryStrategy;
        $this->offerStrategy = $offerStrategy;
    }

    /**
     * Add a product to the basket.
     *
     * @param string $productCode The product code to add to the basket.
     * @return void
     */
    public function add(string $productCode): void
    {
        $this->basket[] = $productCode;
    }

    /**
     * Calculate the total cost of the basket, including offers and delivery costs.
     *
     * @return float The total cost of the basket.
     */
    public function total(): float
    {
        $basketTotal = $this->offerStrategy->applyOffers($this->basket);
        $deliveryCost = $this->deliveryStrategy->calculateDeliveryCost($basketTotal);

        return $basketTotal + $deliveryCost;
    }
}
