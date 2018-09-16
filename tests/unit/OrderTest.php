<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 12:16
 */

namespace Test\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Test\Domain\Customer;
use Test\Domain\Discount\Discount;
use Test\Domain\Order;
use Test\Domain\OrderLine;
use Test\Domain\Product;

final class OrderTest extends TestCase
{
    //To run tests : \vendor\bin>phpunit --bootstrap ../../vendor/autoload.php ../../tests
    /**
     * @test
     */
    public function itCanMakeOrderRight(): void
    {
        $customer = new Customer('Teamleader', 100000);
        $product = new Product('Koerstruitje', 69, 50);
        $orderline1 = new OrderLine($product, 20);
        $orderline2 = new OrderLine($product, 30);
        $orderlines = array(
            'Gent' => $orderline1,
            'Andere' => $orderline2
        );
        $order = new Order($customer, $orderlines);

        //without discount
        $this->assertEquals(
            $order->getCustomer()->getName(),
            $customer->getName()
        );

        $this->assertEquals(
            $order->getOrderLines()['Gent']->getTotal(),
            1000
        );

        $this->assertEquals(
            $order->getTotal(),
            2500
        );

        //discount(s)
        $discounts[] = new Discount(20,'20 euro omdat je getest wordt');

        $order->setDiscounts($discounts);

        $this->assertEquals(
            $order->getTotalDiscountedAmount(),
            20
        );
    }
}