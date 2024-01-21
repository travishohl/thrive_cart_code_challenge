<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use ThriftCartCodeChallenge\Basket;
use ThriftCartCodeChallenge\Catalog;
use ThriftCartCodeChallenge\Strategies\FreeDelivery;
use ThriftCartCodeChallenge\Strategies\LargerBasketsDecreaseDeliveryCharge;
use ThriftCartCodeChallenge\Product;

final class BasketTest extends TestCase
{
    public function test_class_can_be_instantiated(): void
    {
        $basket = new Basket(
            Catalog::fromProductList([]),
            new FreeDelivery()
        );

        $this->assertInstanceOf(Basket::class, $basket);
    }

    public function test_add_method_adds_a_product_to_the_basket(): void
    {
        $product = Product::fromCodeAndPrice('some_product_code', 1000);

        $basket = new Basket(
            Catalog::fromProductList([$product]),
            new LargerBasketsDecreaseDeliveryCharge()
        );

        $basket->add($product);

        $this->assertTrue($basket->isProductAdded($product));
    }

    public function test_add_method_throws_domain_exception_for_products_not_in_catalog(): void
    {
        $product = Product::fromCodeAndPrice('not_in_catalog', 12345);

        $basket = new Basket(
            Catalog::fromProductList([]),
            new LargerBasketsDecreaseDeliveryCharge()
        );

        $this->expectException(DomainException::class);

        $basket->add($product);
    }

    public function test_isProductAdded_method_is_not_case_sensitive(): void
    {
        $mixed_case_product_code = 'SoMe_ProDuCt_CoDe';
        $product_with_mixed_case_code = Product::fromCodeAndPrice($mixed_case_product_code, 1000);

        $basket = new Basket(
            Catalog::fromProductList([$product_with_mixed_case_code]),
            new LargerBasketsDecreaseDeliveryCharge()
        );

        $basket->add($product_with_mixed_case_code);

        $uppercase_product_code = strtoupper($mixed_case_product_code);
        $product_with_uppercase_code = Product::fromCodeAndPrice($uppercase_product_code, 1000);

        $this->assertTrue($basket->isProductAdded($product_with_uppercase_code));
    }

    public function test_total_method_returns_int_representing_total_basket_price_in_cents(): void
    {
        $basket = new Basket(
            Catalog::fromProductList([
                Product::fromCodeAndPrice('ABC', 100),
            ]),
            new FreeDelivery()
        );

        $basket->add(Product::fromCodeAndPrice('ABC', 100));
        $basket->add(Product::fromCodeAndPrice('ABC', 100));

        $this->assertSame($basket->total(), 200);
    }

    public function test_total_method_correctly_considers_delivery_charges(): void
    {
        $basket = new Basket(
            Catalog::fromProductList([
                Product::fromCodeAndPrice('B01', 795),
                Product::fromCodeAndPrice('G01', 2495),
            ]),
            new LargerBasketsDecreaseDeliveryCharge()
        );

        $basket->add(Product::fromCodeAndPrice('B01', 795));
        $basket->add(Product::fromCodeAndPrice('G01', 2495));

        $this->assertSame($basket->total(), 3785);
    }
}
