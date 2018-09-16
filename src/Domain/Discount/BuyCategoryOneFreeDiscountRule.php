<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 15:25
 */

namespace Test\Domain\Discount;

use Test\Domain\Order;

class BuyCategoryOneFreeDiscountRule implements DiscountRule
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
     * @param int $categoryId
     * @param int $trigger
     */
    public function __construct(
        int $categoryId,
        int $trigger
    )
    {
        $this->categoryId = $categoryId;
        $this->trigger = $trigger;
    }

    /**
     * @param Order $order
     * @return Discount|null
     */
    public function calculate(Order $order): ?Discount
    {
        $totalDiscount = 0;
        foreach ($order->getOrderLines() as $item){
            if($item->getProduct()->getCategory() == $this->categoryId){
                $freeProducts = $this->findGrade($item->getQuantity(), $this->trigger);
                $discount = $freeProducts * $item->getProduct()->getPrice();
                $totalDiscount += $discount;
            }
        }
        if($totalDiscount > 0){
            $orderDiscount = new Discount($totalDiscount,
                'For every item from product category ' . $this->categoryId . ' the order gets 1 free product for every ' . $this->trigger . 'th ordered.');
            return $orderDiscount;
        }
        return null;
    }

    /**
     * @param float $numerator
     * @param int $denominator
     * @return int
     */
    private function findGrade(float $numerator, int $denominator): int
    {
        return floor($numerator/$denominator);
    }
}