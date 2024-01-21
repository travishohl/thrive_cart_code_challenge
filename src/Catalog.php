<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge;

use ThriftCartCodeChallenge\Product;

class Catalog
{
    /**
     * @var array<Product> $products
     */
    private array $products = [];

    /**
     * @param array<Product> $product_list
     *
     * @return self
     */
    private function __construct(array $product_list)
    {
        foreach ($product_list as $product) {
            $this->products[] = $product;
        }
    }

    /**
     * @param array<Product> $product_list
     *
     * @return self
     */
    public static function fromProductList(array $product_list): self
    {
        return new self($product_list);
    }

    /**
     * @param Product $product
     *
     * @return bool
     */
    public function productExists(Product $product): bool
    {
        $input_product_code = $product->getCode();

        foreach ($this->products as $product) {
            if ($product->getCode() === $input_product_code) return true;
        }

        return false;
    }
}
