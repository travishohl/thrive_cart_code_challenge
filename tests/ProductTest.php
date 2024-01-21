<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use ThriftCartCodeChallenge\Product;

final class ProductTest extends TestCase
{
    public function test_class_can_be_instantiated_fromCodeAndPrice(): void
    {
        $product = Product::fromCodeAndPrice('ABC', 123);

        $this->assertInstanceOf(Product::class, $product);
    }

    public function test_getPrice_returns_an_integer_representing_the_product_price_in_cents(): void
    {
        $product = Product::fromCodeAndPrice('ABC', 500);

        $this->assertSame($product->getPrice(), 500);
    }

    public function test_getCode_returns_a_string_representing_the_product_code(): void
    {
        $product = Product::fromCodeAndPrice('ABC', 500);

        $this->assertSame($product->getCode(), 'ABC');
    }

    public function test_getCode_returns_an_uppercase_string_even_when_given_a_lowercase_string(): void
    {
        $product = Product::fromCodeAndPrice('abc', 500);

        $this->assertSame($product->getCode(), 'ABC');
    }
}
