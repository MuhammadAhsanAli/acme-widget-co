<?php

namespace Tests\Unit\Offer;

use Acme\WidgetCo\ProductCatalogue;
use PHPUnit\Framework\TestCase;
use Acme\WidgetCo\Offer\RedWidgetOfferStrategy;

/**
 * Class RedWidgetOfferStrategyTest
 *
 * Unit tests for the RedWidgetOfferStrategy class.
 */
class RedWidgetOfferStrategyTest extends TestCase
{
    /**
     * @var RedWidgetOfferStrategy The offer strategy instance to be tested.
     */
    private RedWidgetOfferStrategy $strategy;

    /**
     * @var float The tolerance for floating point comparisons.
     */
    private float $delta = 0.01;

    /**
     * Set up the test environment.
     *
     * Initializes the RedWidgetOfferStrategy instance with a ProductCatalogue before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $products = [
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95
        ];
        $this->strategy = new RedWidgetOfferStrategy( new ProductCatalogue($products));
    }

    /**
     * Test applying the offer with two red widgets.
     *
     * For two red widgets, the second one should be at half price.
     *
     * @return void
     */
    public function testApplyOffer(): void
    {
        $items = ['R01', 'R01'];
        $this->assertEqualsWithDelta(49.42, $this->strategy->applyOffers($items), $this->delta);
    }

    /**
     * Test applying the offer with no red widgets.
     *
     * No offer should be applied; total should be the sum of non-red widgets.
     *
     * @return void
     */
    public function testApplyOfferWithNoRedWidgets(): void
    {
        $items = ['G01', 'B01'];
        $this->assertEqualsWithDelta(32.90, $this->strategy->applyOffers($items), $this->delta);
    }

    /**
     * Test applying the offer with a single red widget.
     *
     * No discount should be applied; total should be the price of the single red widget.
     *
     * @return void
     */
    public function testApplyOfferWithSingleRedWidget(): void
    {
        $items = ['R01'];
        $this->assertEqualsWithDelta(32.95, $this->strategy->applyOffers($items), $this->delta);
    }
}
