<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 15:25
 */

namespace Test\Domain\Discount;

use Test\Domain\Order;
use Test\Domain\OrderLine;

class BuyCategoryCheapestProductDiscountRule implements DiscountRule
{
    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var int
     */
    private $trigger;

    /**
     * @var float
     */
    private $discountApplied;

    /**
     * @param int $categoryId
     * @param int $trigger
     * @param float $discountApplied
     */
    public function __construct(
        int $categoryId,
        int $trigger,
        float $discountApplied
    )
    {
        $this->categoryId = $categoryId;
        $this->trigger = $trigger;
        $this->discountApplied = $discountApplied;
    }

    /**
     * @param Order $order
     * @return Discount|null
     */
    public function calculate(Order $order): ?Discount
    {
        $orderLine = $this->getCheapestOrderLineMeetingConditions($order);

        if(!is_null($orderLine)){
            $discountOnLine = $orderLine->getTotal() * $this->discountApplied;
            $discount = new Discount($discountOnLine,
                'Since the order has over ' . $this->trigger . ' from product category ' . $this->categoryId .
                ' ' . $this->discountApplied * 100 . '% is discounted on the cheapest item.');

            return $discount;
        }
        return null;
    }

    /**
     * @param Order $order
     * @return OrderLine|null
     */
    public function getCheapestOrderLineMeetingConditions(Order $order): ?OrderLine
    {
        $orderLinesMatchingTheCategory = array_filter($order->getOrderLines(), function (OrderLine $line) {
            return $line->getProduct()->getCategory() == $this->categoryId;
        });

        if (count($orderLinesMatchingTheCategory) >= $this->trigger) {
            usort($orderLinesMatchingTheCategory, function (OrderLine $a, OrderLine $b) {
                if ($a->getTotal() == $b->getTotal()) return 0;
                return ($a->getTotal() < $b->getTotal()) ? -1 : 1;
            });
            return $orderLinesMatchingTheCategory[0];
        }
        return null;
    }
}