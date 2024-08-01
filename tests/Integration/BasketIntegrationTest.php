<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Acme\WidgetCo\Basket;
use Acme\WidgetCo\ProductCatalogue;
use Acme\WidgetCo\Delivery\StandardDeliveryStrategy;
use Acme\WidgetCo\Offer\RedWidgetOfferStrategy;

/**
 * Class BasketIntegrationTest
 *
 * Integration tests for the Basket class to ensure correct interaction between components.
 */
class BasketIntegrationTest extends TestCase
{
    /**
     * @var Basket The basket instance to be tested.
     */
    private Basket $basket;

    /**
     * @var float The tolerance for floating point comparisons.
     */
    private float $delta = 0.01;

    /**
     * Set up the test environment.
     *
     * Initializes the Basket instance with a ProductCatalogue and strategies before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Initialize product catalogue with sample data
        $catalogue = new ProductCatalogue([
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95
        ]);

        // Initialize basket with catalogue and strategies
        $this->basket = new Basket(
            $catalogue,
            new StandardDeliveryStrategy(),
            new RedWidgetOfferStrategy($catalogue)
        );
    }

    /**
     * Test basket total with multiple products.
     *
     * Verifies the total cost of the basket with a mix of products and checks the correct application of offers and delivery costs.
     *
     * @return void
     */
    public function testBasketWithMultipleProducts(): void
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('G01');
        $this->basket->add('B01');

        // Total calculation: (32.95 + 16.475) + 24.95 + 7.95 = 49.42 + 24.95 + 7.95 = 82.32
        // Delivery cost for orders under $90 is $2.95
        $this->assertEqualsWithDelta(85.27, $this->basket->total(), $this->delta);
    }

    /**
     * Test basket total with offer and delivery cost.
     *
     * Verifies the total cost of the basket with an offer applied and ensures that delivery cost is correctly calculated.
     *
     * @return void
     */
    public function testBasketWithOfferAndDeliveryCost(): void
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('G01');
        $this->basket->add('B01');

        // Total calculation: (32.95 x 2 + 16.475) + 24.95 + 7.95 = 82.375 + 24.95 + 7.95 = 115.27
        // Delivery cost for orders >= $90 is 0
        $this->assertEqualsWithDelta(115.27, $this->basket->total(), $this->delta);
    }
}
