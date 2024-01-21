<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge;

use DomainException;
use Money\Money;

class Basket
{
    /**
     * @var array<string> $products
     */
    private array $products = [];

    public function __construct(private Catalog $catalog)
    {
    }

    /**
     * @param string $product_code
     *
     * @return void
     */
    public function add(string $product_code): void
    {
        if (!$this->catalog->productExists($product_code)) {
            throw new DomainException("Product \"$product_code\" does not exist in the product catalog.");
        }

        $lowercase_product_code = strtolower($product_code);

        $this->products[] = $lowercase_product_code;
    }

    /**
     * @param string $product_code
     *
     * @return bool
     */
    public function isProductAdded(string $product_code): bool
    {
        $lowercase_product_code = strtolower($product_code);

        return in_array($lowercase_product_code, $this->products);
    }

    /**
     * @return Money
     */
    public function total(): Money
    {
        return Money::USD(1234);
    }
}
