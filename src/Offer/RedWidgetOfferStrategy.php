<?php

namespace Acme\WidgetCo\Offer;

use Acme\WidgetCo\ProductCatalogue;

/**
 * Class RedWidgetOfferStrategy
 *
 * This class implements an offer strategy for red widgets.
 */
class RedWidgetOfferStrategy implements OfferStrategyInterface
{
    /**
     * @var ProductCatalogue The product catalogue used to get product prices.
     */
    private ProductCatalogue $catalogue;

    /**
     * RedWidgetOfferStrategy constructor.
     *
     * @param ProductCatalogue $catalogue The product catalogue instance.
     */
    public function __construct(ProductCatalogue $catalogue)
    {
        $this->catalogue = $catalogue;
    }

    /**
     * Apply offers to the given basket and calculate the total cost after offers.
     *
     * This method implements a specific offer: Buy one red widget, get the second at half price.
     *
     * @param array $basket An array representing the items in the basket.
     * @return float The total cost after applying offers.
     */
    public function applyOffers(array $basket): float
    {
        $total = 0.0;
        $redWidgetCount = 0;

        foreach ($basket as $code) {
            if ($code === 'R01') {
                $redWidgetCount++;
            } else {
                $total += $this->catalogue->getPrice($code);
            }
        }

        // Apply offer: Buy one red widget, get the second at half price
        $prices = [
            'full' => $this->catalogue->getPrice('R01'),
            'half' => $this->catalogue->getPrice('R01') / 2
        ];

        for ($i = 0; $i < $redWidgetCount; $i++) {
            $total += ($i % 2 === 0) ? $prices['full'] : $prices['half'];
        }

        return $total;
    }
}
