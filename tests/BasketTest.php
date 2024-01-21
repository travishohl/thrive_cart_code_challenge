<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ThriftCartCodeChallenge\Basket;

final class BasketTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $basket = new Basket();

        $this->assertInstanceOf(Basket::class, $basket);
    }

    public function testTotalMethodReturnsFloat(): void
    {
        $basket = new Basket();

        $this->assertIsFloat($basket->total());
    }
}
