<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use ThriftCartCodeChallenge\Strategies\LargerBasketsDecreaseDeliveryCharge;

final class LargerBasketsDecreaseDeliveryChargeTest extends TestCase
{
    public function test_calculateDeliveryCharges_returns_4_95_for_totals_under_50_dollars(): void
    {
        $totals_under_fifty_dollars = [
            100,
            200,
            3000,
            3999,
            4001,
            4999,
        ];

        foreach ($totals_under_fifty_dollars as $basket_total) {
            $delivery_charge = LargerBasketsDecreaseDeliveryCharge::calculateDeliveryCharges($basket_total);

            $this->assertSame($delivery_charge, 495);
        }
    }
}
