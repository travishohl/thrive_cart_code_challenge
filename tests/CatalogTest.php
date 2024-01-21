<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use ThriftCartCodeChallenge\Catalog;

final class CatalogTest extends TestCase
{
    public function test_class_can_be_instantiated_fromProductList(): void
    {
        $catalog = Catalog::fromProductList([]);

        $this->assertInstanceOf(Catalog::class, $catalog);
    }

    public function test_productExists_returns_true_when_product_exists_in_catalog(): void
    {
        $product_code = 'scooter';

        $catalog = Catalog::fromProductList([$product_code]);

        $this->assertTrue($catalog->productExists($product_code));
    }

    public function test_productExists_returns_false_when_product_does_not_exist_in_catalog(): void
    {
        $existing_product_code = 'scooter';
        $missing_product_code = 'giraffe';

        $catalog = Catalog::fromProductList([$existing_product_code]);

        $this->assertFalse($catalog->productExists($missing_product_code));
    }
}
