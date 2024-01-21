<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge;

use DomainException;
use ThriftCartCodeChallenge\Interfaces\DeliveryChargeRule;
use ThriftCartCodeChallenge\Product;

class Basket
{
    /**
     * @var array<Product> $products
     */
    private array $products = [];

    public function __construct(private Catalog $catalog, private DeliveryChargeRule $delivery_charge_rule)
    {
        // Do nothing.
    }

    /**
     * @param Product $product
     *
     * @return void
     */
    public function add(Product $product): void
    {
        if (!$this->catalog->productExists($product)) {
            throw new DomainException("Cannot add product \"$product\" as it does not exist in the catalog.");
        }

        $this->products[] = $product;
    }

    /**
     * @param Product $product
     *
     * @return bool
     */
    public function isProductAdded(Product $product): bool
    {
        $input_product_code = $product->getCode();

        foreach ($this->products as $product) {
            if ($product->getCode() === $input_product_code) return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function total(): int
    {
        $total_basket = array_reduce(
            $this->products,
            function ($carry, $product) {
                return $carry + $product->getPrice();
            },
            0
        );

        $delivery_charges = $this->delivery_charge_rule->calculateDeliveryCharges($total_basket);

        return $total_basket + $delivery_charges;
    }
}
