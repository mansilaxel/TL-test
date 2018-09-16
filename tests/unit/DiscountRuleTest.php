<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 14:45
 */

namespace Test\Tests\unit;

use PHPUnit\Framework\TestCase;
use Test\Database\OrderRepository;
use Test\Domain\Discount\BuyCategoryCheapestProductDiscountRule;
use Test\Domain\Discount\BuyCategoryOneFreeDiscountRule;
use Test\Domain\Discount\DiscountRule;
use Test\Domain\Discount\OnTotalDiscountRule;

final class DiscountRuleTest extends TestCase
{
    /**
     * @var DiscountRule
     */
    private $discountRule;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function setUp()
    {
        $this->orderRepository = new OrderRepository();
    }

    /**
     * @test
     */
    public function itCalculatesOnTotalDiscount(): void
    {
        $this->discountRule = new OnTotalDiscountRule(25,0.1);
        $order = $this->orderRepository->findById(1);

        $discount = $this->discountRule->calculate($order);
        $this->assertEquals(
          $discount->getAmount(),
          4.99
        );
    }

    /**
     * @test
     */
    public function itCalculatesBuyXGetOneFreeDiscount(): void
    {
        $this->discountRule = new BuyCategoryOneFreeDiscountRule(2,5);
        $order = $this->orderRepository->findById(1);

        $discount = $this->discountRule->calculate($order);
        $this->assertEquals(
            $discount->getAmount(),
            4.99 * 2
        );
    }

    /**
     * @test
     */
    public function itCalculatesBuyCategoryXTimesCheapestItemDiscount(): void
    {
        $this->discountRule = new BuyCategoryCheapestProductDiscountRule(1,2, 0.5);
        $order = $this->orderRepository->findById(3);

        $discount = $this->discountRule->calculate($order);
        $this->assertEquals(
            $discount->getAmount(),
            19.50 * 0.5
        );
    }
}