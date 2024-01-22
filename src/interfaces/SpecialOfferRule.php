<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge\Interfaces;

use ThriftCartCodeChallenge\Product;

interface SpecialOfferRule
{
    /**
     * @param array<Product> $products
     */
    public function calculateSpecialOfferDiscount(array $products): int;
}
