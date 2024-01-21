<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge\Interfaces;

interface DeliveryChargeRule
{
    public function calculateDeliveryCharges(int $basket_total): int;
}
