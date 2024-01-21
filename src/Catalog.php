<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge;

use Money\Money;

class Catalog
{
    /**
     * @var array<string> $products
     */
    private array $products = [];

    /**
     * @param array<string> $product_list
     *
     * @return self
     */
    private function __construct(array $product_list)
    {
        foreach ($product_list as $product) {
            $this->products[] = strtolower($product);
        }
    }

    /**
     * @param array<string> $product_list
     *
     * @return self
     */
    public static function fromProductList(array $product_list): self
    {
        return new self($product_list);
    }

    /**
     * @param string $product_code
     *
     * @return bool
     */
    public function productExists(string $product_code): bool
    {
        $lowercase_product_code = strtolower($product_code);

        return in_array($lowercase_product_code, $this->products);
    }
}
