<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge\Strategies;

use ThriftCartCodeChallenge\Interfaces\SpecialOfferRule;

class SecondHalfPriceSpecialOfferRule implements SpecialOfferRule
{
    /**
     * @inherit
     */
    public function calculateSpecialOfferDiscount(array $products): int
    {
        $special_offer_product_code = 'R01';
        $special_offer_products_found = 0;

        $discount = array_reduce(
            $products,
            function ($carry, $product) use ($special_offer_product_code, &$special_offer_products_found) {
                if ($product->getCode() !== $special_offer_product_code) return $carry;

                $special_offer_products_found = $special_offer_products_found + 1;
                
                if ($special_offer_products_found === 2) {
                    return $carry + $product->calculateHalfOffDiscount();
                }

                return $carry;
            },
            0
        );

        return $discount;
    }
}
