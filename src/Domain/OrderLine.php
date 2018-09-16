<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 11:57
 */

namespace Test\Domain;

class OrderLine
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float
     */
    private $total;

    /**
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(
        Product $product,
        int $quantity
    )
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->total = $product->getPrice() * $quantity;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return round($this->total, 2);
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

}