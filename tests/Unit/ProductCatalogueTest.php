<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Acme\WidgetCo\ProductCatalogue;

/**
 * Class ProductCatalogueTest
 *
 * Unit tests for the ProductCatalogue class.
 */
class ProductCatalogueTest extends TestCase
{
    /**
     * @var ProductCatalogue The product catalogue instance to be tested.
     */
    private ProductCatalogue $catalogue;

    /**
     * Set up the test environment.
     *
     * Initializes the ProductCatalogue instance with sample products before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->catalogue = new ProductCatalogue([
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95
        ]);
    }

    /**
     * Test retrieving the price of known products.
     *
     * Verifies that the prices for known product codes are returned correctly.
     *
     * @return void
     */
    public function testGetPrice(): void
    {
        $this->assertEquals(32.95, $this->catalogue->getPrice('R01'));
        $this->assertEquals(24.95, $this->catalogue->getPrice('G01'));
        $this->assertEquals(7.95, $this->catalogue->getPrice('B01'));
    }

    /**
     * Test retrieving the price for an unknown product.
     *
     * Verifies that an exception is thrown when requesting the price for an unknown product code.
     *
     * @return void
     */
    public function testGetPriceForUnknownProduct(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->catalogue->getPrice('UNKNOWN');
    }
}
