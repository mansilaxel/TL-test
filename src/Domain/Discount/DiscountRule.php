<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 14:37
 */

namespace Test\Domain\Discount;

use Test\Domain\Order;

interface DiscountRule
{
    /**
     * @param Order $order
     * @return Discount|null
     */
    public function calculate(Order $order): ?Discount;
}