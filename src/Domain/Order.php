<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 12:03
 */

namespace Test\Domain;

use Test\Domain\Discount\Discount;

class Order
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var OrderLine[]
     */
    private $orderLines;

    /**
     * @var float
     */
    private $total;

    /**
     * @var Discount[]
     */
    private $discounts;

    /**
     * Order constructor.
     * @param Customer $customer
     * @param OrderLine[] $orderLines
     */
    public function __construct(
        Customer $customer,
        array $orderLines
    )
    {
        $this->customer = $customer;
        $this->orderLines = $orderLines;
        foreach ($orderLines as $item){
            $this->total+= $item->getTotal();
        }
        $this->discounts = [];
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
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return OrderLine[]
     */
    public function getOrderLines(): array
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLine[] $orderLines
     */
    public function setOrderLines(array $orderLines): void
    {
        $this->orderLines = $orderLines;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    /**
     * @param array $json
     * @param Customer $customer
     * @param array $orderLines
     * @return Order
     */
    public static function createFromJson(array $json, Customer $customer, array $orderLines): self
    {
        $order = new Order($customer, $orderLines);
        $order->setId($json['id']);

        return $order;
    }

    /**
     * @return Discount[]
     */
    public function getDiscounts(): array
    {
        return $this->discounts;
    }

    /**
     * @param Discount[] $discounts
     */
    public function setDiscounts(array $discounts): void
    {
        $this->discounts = $discounts;
    }

    /**
     * @return float
     */
    public function getTotalDiscountedAmount(): float
    {
        $total = 0;
        foreach ($this->discounts as $discount) {
            $total+= $discount->getAmount();
        }
        return round($total, 2);
    }

}
