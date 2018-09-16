<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 11:54
 */

namespace Test\Domain;

class Product
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $category;

    /**
     * @var float
     */
    private $price;

    /**
     * @param string $description
     * @param int $category
     * @param float $price
     */
    public function __construct(
        string $description,
        int $category,
        float $price
    )
    {
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param array $json
     * @return Product
     */
    public static function createFromJson(array $json): self
    {
        $product = new Product($json['description'], $json['category'], $json['price']);
        $id = $json['id'];

        $product->setId($id);
        return $product;
    }
    
}