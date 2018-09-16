<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 11:50
 */

namespace Test\Domain;

class Customer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;
    
    /**
     * @var float
     */
    private $revenue;

    /**
     * @param string $name
     * @param float $revenue
     */
    public function __construct(
        string $name,
        float $revenue
    )
    {
        $this->name = $name;
        $this->revenue = $revenue;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getRevenue(): float
    {
        return $this->revenue;
    }

    /**
     * @param float $revenue
     */
    public function setRevenue(float $revenue): void
    {
        $this->revenue = $revenue;
    }
}