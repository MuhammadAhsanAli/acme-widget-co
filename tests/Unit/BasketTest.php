<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Acme\WidgetCo\Basket;
use Acme\WidgetCo\ProductCatalogue;
use Acme\WidgetCo\Delivery\StandardDeliveryStrategy;
use Acme\WidgetCo\Offer\RedWidgetOfferStrategy;

/**
 * Class BasketTest
 *
 * Unit tests for the Basket class, including testing product addition, offer application, and delivery cost calculation.
 */
class BasketTest extends TestCase
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
     * Test adding a product to the basket.
     *
     * Verifies that adding a product updates the total cost correctly.
     *
     * @return void
     */
    public function testAddProduct(): void
    {
        $this->basket->add('B01');
        $this->assertEqualsWithDelta(12.90, $this->basket->total(), $this->delta);
    }

    /**
     * Test applying the offer for red widgets.
     *
     * Verifies that the offer applies correctly when there are multiple red widgets.
     *
     * @return void
     */
    public function testApplyOffer(): void
    {
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->assertEqualsWithDelta(54.37, $this->basket->total(), $this->delta);
    }

    /**
     * Test calculating the delivery cost with multiple products.
     *
     * Verifies that the delivery cost is calculated correctly based on the total basket amount and applies the offer.
     *
     * @return void
     */
    public function testCalculateDeliveryCost(): void
    {
        $this->basket->add('B01');
        $this->basket->add('B01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');

        // Total without discount: 2 x 7.95 + 3 x 32.95 = 114.75
        // Total offer = 114.75 - 16.475 = 98.27
        // Delivery cost for orders >= $90 is free
        $this->assertEqualsWithDelta(98.27, $this->basket->total(), $this->delta);
    }
}
