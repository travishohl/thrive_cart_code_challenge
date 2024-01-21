<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge;

use DomainException;
use ThriftCartCodeChallenge\Product;

class Basket
{
    /**
     * @var array<Product> $products
     */
    private array $products = [];

    public function __construct(private Catalog $catalog)
    {
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
        $total_price = array_reduce(
            $this->products,
            function ($carry, $product) {
                return $carry + $product->getPrice();
            },
            0
        );

        return $total_price;
    }
}
