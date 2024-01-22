<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge\Strategies;

use ThriftCartCodeChallenge\Interfaces\DeliveryChargeRule;

class FreeDeliveryChargeRule implements DeliveryChargeRule
{
    /**
     * @param int $basket_total_in_cents
     *
     * @return int
     */
    public function calculateDeliveryCharges(int $basket_total_in_cents): int
    {
        return 0;
    }
}
