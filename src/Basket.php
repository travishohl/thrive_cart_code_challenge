<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge;

use Money\Money;

class Basket
{
    public function __construct()
    {
    }

    public function total(): Money
    {
        return Money::USD(1234);
    }
}
