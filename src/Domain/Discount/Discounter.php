<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 15:49
 */

namespace Test\Domain\Discount;

use Test\Domain\Order;

class Discounter
{
    /**
     * @var DiscountRule []
     */
    private $discountRules;

    public function __construct()
    {
        $this->discountRules [] = new OnTotalDiscountRule(1000,0.1);
        $this->discountRules [] = new BuyCategoryOneFreeDiscountRule(2,5);
        $this->discountRules [] = new BuyCategoryCheapestProductDiscountRule(1,2,0.1);

        //own rule since no order has a total over 1000
        $this->discountRules [] = new OnTotalDiscountRule(40,0.15);
    }

    /**
     * @param Order $order
     * @param bool $combined
     * @param bool $low
     */
    public function apply(Order $order, bool $combined, bool $low = false)
    {
        $combined ? $this->CalculateTotalPriceWithAllDiscounts($order) : $this->CalculateTotalPriceWithBestDiscount($order, $low);
    }
    /**
     * @param Order $order
     * @return float
     */
    private function CalculateTotalPriceWithAllDiscounts(Order $order): float
    {
        $discounts = [];
        foreach ($this->discountRules as $discountRule){
            $discount = $discountRule->calculate($order);
            if (!is_null($discount)){
                $discounts[] = $discount;
            }
        }

        if (count($discounts) >= 1) {
            $order->setDiscounts($discounts);
            $order->setTotal($order->getTotal() - $order->getTotalDiscountedAmount());
        }
        return $order->getTotal();
    }

    /**
     * @param Order $order
     * @param bool $low
     * @return float
     */
    private function CalculateTotalPriceWithBestDiscount(Order $order, bool $low): float
    {
        $discounts = [];
        foreach ($this->discountRules as $discountRule){
            $discount = $discountRule->calculate($order);
            if (!is_null($discount)){
                $discounts[] = $discount;
            }
        }

        if (count($discounts) >= 1) {
            $bestOne[] = $this->getMostOptimalDiscount($discounts, $low);
            $order->setDiscounts($bestOne);
            $order->setTotal($order->getTotal() - $order->getTotalDiscountedAmount());
        }
        return $order->getTotal();
    }

    /**
     * @param Discount[] $discounts
     * @param bool $asc
     * @return Discount
     */
    private function getMostOptimalDiscount(array $discounts, bool $asc)
    {
        usort($discounts, function (Discount $a, Discount $b) {
            if($a->getAmount() == $b->getAmount()) return 0;
            return ($a->getAmount() < $b->getAmount()) ? -1 : 1;
        });
        if($asc) {
            return $discounts[0];
        }
        return $discounts[count($discounts) -1 ];
    }
}