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
     * @var int
     */
    private $price = 0;

    /**
     * @param string $sku
     * @param int $quantity
     * @param int $price
     */
    public function __construct(string $sku, int $quantity, int $price)
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
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}
