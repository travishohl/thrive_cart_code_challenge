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

        $strategy = new LargerBasketsDecreaseDeliveryCharge();

        foreach ($totals_under_fifty_dollars as $basket_total) {
            $delivery_charge = $strategy->calculateDeliveryCharges($basket_total);

            $this->assertSame($delivery_charge, 495);
        }
    }

    public function test_calculateDeliveryCharges_returns_2_95_for_totals_under_90_dollars(): void
    {
        $totals_under_ninety_dollars = [
            5000,
            6000,
            7000,
            8000,
            8999,
        ];

        $strategy = new LargerBasketsDecreaseDeliveryCharge();

        foreach ($totals_under_ninety_dollars as $basket_total) {
            $delivery_charge = $strategy->calculateDeliveryCharges($basket_total);

            $this->assertSame($delivery_charge, 295);
        }
    }

    public function test_calculateDeliveryCharges_returns_0_for_totals_greater_than_90_dollars(): void
    {
        $totals_greater_than_or_equal_to_ninety_dollars = [
            9000,
            9001,
            10000,
            11000,
            12999,
            100000000,
        ];

        $strategy = new LargerBasketsDecreaseDeliveryCharge();

        foreach ($totals_greater_than_or_equal_to_ninety_dollars as $basket_total) {
            $delivery_charge = $strategy->calculateDeliveryCharges($basket_total);

            $this->assertSame($delivery_charge, 0);
        }
    }
}
