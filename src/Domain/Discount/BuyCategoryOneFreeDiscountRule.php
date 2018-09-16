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
     * @param Order $order
     * @return Discount|null
     */
    public function calculate(Order $order): ?Discount
    {
        // TODO: Implement calculate() method.
    }
}