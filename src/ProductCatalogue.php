<?php

namespace Acme\WidgetCo;

use InvalidArgumentException;

/**
 * Class ProductCatalogue
 *
 * This class represents a product catalogue used to retrieve product prices.
 */
class ProductCatalogue
{
    /**
     * @var array An array representing the products and their prices.
     */
    private array $products;

    /**
     * ProductCatalogue constructor.
     *
     * @param array $products An array of products and their corresponding prices.
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * Get the price of a product by its code.
     *
     * @param string $productCode The product code to retrieve the price for.
     * @return float The price of the product.
     * @throws InvalidArgumentException If the product code is not found in the catalogue.
     */
    public function getPrice(string $productCode): float
    {
        if (!isset($this->products[$productCode])) {
            throw new InvalidArgumentException("Product code not found.");
        }

        return $this->products[$productCode];
    }
}
