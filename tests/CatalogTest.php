<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use ThriftCartCodeChallenge\Catalog;
use ThriftCartCodeChallenge\Product;

final class CatalogTest extends TestCase
{
    public function test_class_can_be_instantiated_fromProductList(): void
    {
        $catalog = Catalog::fromProductList([]);

        $this->assertInstanceOf(Catalog::class, $catalog);
    }

    public function test_productExists_returns_true_when_product_exists_in_catalog(): void
    {
        $product = Product::fromCodeAndPrice('scooter', 80000);
        $identical_product = Product::fromCodeAndPrice('scooter', 80000);

        $catalog = Catalog::fromProductList([$product]);

        $this->assertTrue($catalog->productExists($identical_product));
    }

    public function test_productExists_returns_false_when_product_does_not_exist_in_catalog(): void
    {
        $existing_product = Product::fromCodeAndPrice('scooter', 80000);
        $missing_product = Product::fromCodeAndPrice('giraffe', 6000000);

        $catalog = Catalog::fromProductList([$existing_product]);

        $this->assertFalse($catalog->productExists($missing_product));
    }
}
