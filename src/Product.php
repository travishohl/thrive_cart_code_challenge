<?php declare(strict_types=1);

namespace ThriftCartCodeChallenge;

class Product
{
    /**
     * @param string $product_code
     * @param int $product_price_in_cents
     *
     * @return self
     */
    private function __construct(private string $product_code, private int $product_price_in_cents)
    {
        $this->product_code = strtoupper($product_code);
    }

    /**
     * @param string $product_code
     * @param int $product_price_in_cents
     *
     * @return self
     */
    public static function fromCodeAndPrice(string $product_code, int $product_price_in_cents): self
    {
        return new self($product_code, $product_price_in_cents);
    }

    public function calculateHalfOffDiscount(): int
    {
        return (int) round($this->getPrice() / 2);
    }

    public function getCode(): string
    {
        return $this->product_code;
    }

    public function getPrice(): int
    {
        return $this->product_price_in_cents;
    }

    public function __toString()
    {
        return $this->getCode();
    }
}
