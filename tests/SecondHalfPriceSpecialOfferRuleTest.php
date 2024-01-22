<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use ThriftCartCodeChallenge\Product;
use ThriftCartCodeChallenge\Strategies\SecondHalfPriceSpecialOfferRule;

final class SecondHalfPriceSpecialOfferRuleTest extends TestCase
{
    public function test_calculateSpecialOfferDiscount_discounts_second_special_product_when_given_two_special_products(): void
    {
        $two_special_products = [
            Product::fromCodeAndPrice('R01', 3295),
            Product::fromCodeAndPrice('R01', 3295),
        ];

        $expected_discount = 1648; // (price / 2) and rounded to nearest cent

        $strategy = new SecondHalfPriceSpecialOfferRule();

        $actual_discount = $strategy->calculateSpecialOfferDiscount($two_special_products);

        $this->assertSame($expected_discount, $actual_discount);
    }

    public function test_calculateSpecialOfferDiscount_discounts_no_special_product_when_given_one_special_product(): void
    {
        $one_special_product = [
            Product::fromCodeAndPrice('R01', 3295),
            Product::fromCodeAndPrice('G01', 2495),
        ];

        $expected_discount = 0;

        $strategy = new SecondHalfPriceSpecialOfferRule();

        $actual_discount = $strategy->calculateSpecialOfferDiscount($one_special_product);

        $this->assertSame($expected_discount, $actual_discount);
    }

    public function test_calculateSpecialOfferDiscount_discounts_second_special_product_when_given_three_special_products(): void
    {
        $two_special_products = [
            Product::fromCodeAndPrice('R01', 3295),
            Product::fromCodeAndPrice('R01', 3295),
            Product::fromCodeAndPrice('R01', 3295),
        ];

        $expected_discount = 1648; // (price / 2) and rounded to nearest cent

        $strategy = new SecondHalfPriceSpecialOfferRule();

        $actual_discount = $strategy->calculateSpecialOfferDiscount($two_special_products);

        $this->assertSame($expected_discount, $actual_discount);
    }
}
