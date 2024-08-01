<?php

namespace Tests\Unit\Delivery;

use PHPUnit\Framework\TestCase;
use Acme\WidgetCo\Delivery\StandardDeliveryStrategy;

/**
 * Class StandardDeliveryStrategyTest
 *
 * Unit tests for the StandardDeliveryStrategy class.
 */
class StandardDeliveryStrategyTest extends TestCase
{
    /**
     * @var StandardDeliveryStrategy The delivery strategy instance to be tested.
     */
    private StandardDeliveryStrategy $strategy;

    /**
     * Set up the test environment.
     *
     * Initializes the StandardDeliveryStrategy instance before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->strategy = new StandardDeliveryStrategy();
    }

    /**
     * Test the delivery cost when the total cost is under $50.
     *
     * @return void
     */
    public function testDeliveryCostUnder50(): void
    {
        $this->assertEquals(4.95, $this->strategy->calculateDeliveryCost(49.99));
    }

    /**
     * Test the delivery cost when the total cost is between $50 and $89.99.
     *
     * @return void
     */
    public function testDeliveryCostUnder90(): void
    {
        $this->assertEquals(2.95, $this->strategy->calculateDeliveryCost(50.00));
    }

    /**
     * Test the delivery cost when the total cost is $90 or more.
     *
     * @return void
     */
    public function testDeliveryCost90OrMore(): void
    {
        $this->assertEquals(0.0, $this->strategy->calculateDeliveryCost(90.00));
    }
}
