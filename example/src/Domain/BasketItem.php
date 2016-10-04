<?php
namespace Kartenmacherei\ExampleService\Domain;

class BasketItem
{
    /**
     * @var string
     */
    private $sku = '';

    /**
     * @var int
     */
    private $quantity = 0;

    /**
     * @var float
     */
    private $price = 0.00;

    /**
     * @param string $sku
     * @param int $quantity
     * @param float $price
     */
    public function __construct(string $sku, int $quantity, float $price)
    {
        $this->sku = $sku;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}
