<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 14:40
 */

namespace Test\Domain\Discount;

use Test\Domain\Order;

class OnTotalDiscountRule implements DiscountRule
{
    /**
     * @var int
     */
    private $requirement;

    /**
     * @var float
     */
    private $discountApplied;

    /**
     * @param int $requirement
     * @param float $discountApplied
     */
    public function __construct(
        int $requirement,
        float $discountApplied
    )
    {
        $this->requirement = $requirement;
        $this->discountApplied = $discountApplied;
    }

    /**
     * @param Order $order
     * @return Discount|null
     */
    public function calculate(Order $order): ?Discount
    {
        $total = $order->getTotal();
        if($total > $this->requirement){
            $discount = new Discount(
                $total * $this->discountApplied,
                $this->discountApplied * 100 . '% is discounted since the total is over '
                . $this->requirement . ' euro.');

            return $discount;
        }
        return null;
    }
}