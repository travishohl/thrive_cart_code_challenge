<?php declare(strict_types=1);

use DomainException;
use Money\Money;
use PHPUnit\Framework\TestCase;

use ThriftCartCodeChallenge\Basket;
use ThriftCartCodeChallenge\Catalog;

final class BasketTest extends TestCase
{
    public function test_class_can_be_instantiated(): void
    {
        $basket = new Basket(Catalog::fromProductList([]));

        $this->assertInstanceOf(Basket::class, $basket);
    }

    public function test_total_method_returns_instance_of_money(): void
    {
        $basket = new Basket(Catalog::fromProductList([]));

        $this->assertInstanceOf(Money::class, $basket->total());
    }

    public function test_add_method_adds_a_product_to_the_basket(): void
    {
        $product_code = 'some_product_code';

        $basket = new Basket(Catalog::fromProductList([
            $product_code,
        ]));

        $basket->add($product_code);

        $this->assertTrue($basket->isProductAdded($product_code));
    }

    public function test_add_method_throws_domain_exception_for_products_not_in_catalog(): void
    {
        $basket = new Basket(Catalog::fromProductList([]));

        $product_code = 'some_product_code';

        $this->expectException(DomainException::class);

        $basket->add($product_code);
    }

    public function test_isProductAdded_method_is_not_case_sensitive(): void
    {
        $product_code = 'SoMe_ProDuCt_CoDe';

        $basket = new Basket(Catalog::fromProductList([
            $product_code,
        ]));

        $basket->add($product_code);

        $uppercase_product_code = strtoupper($product_code);

        $this->assertTrue($basket->isProductAdded($uppercase_product_code));
    }
}
