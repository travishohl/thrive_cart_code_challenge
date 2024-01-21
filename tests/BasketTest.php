<?php declare(strict_types=1);

use Money\Money;
use PHPUnit\Framework\TestCase;
use ThriftCartCodeChallenge\Basket;

final class BasketTest extends TestCase
{
    public function test_class_can_be_instantiated(): void
    {
        $basket = new Basket();

        $this->assertInstanceOf(Basket::class, $basket);
    }

    public function test_total_method_returns_instance_of_money(): void
    {
        $basket = new Basket();

        $this->assertInstanceOf(Money::class, $basket->total());
    }
}
