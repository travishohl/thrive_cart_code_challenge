<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge\Strategies;

use ThriftCartCodeChallenge\Interfaces\DeliveryChargeRule;

class FreeDelivery implements DeliveryChargeRule
{
    /**
     * @param int $basket_total_in_cents
     *
     * @return int
     */
    public static function calculateDeliveryCharges(int $basket_total_in_cents): int
    {
        return 0;
    }
}
