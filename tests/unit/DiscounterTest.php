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
use Test\Domain\Discount\Discounter;

final class DiscounterTest extends TestCase
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var Discounter
     */
    private $discounter;

    public function setUp()
    {
        $this->orderRepository = new OrderRepository();
        $this->discounter = new Discounter();
    }

    /**
     * @test
     */
    public function itAppliesCombinedDiscount(): void
    {
        $order = $this->orderRepository->findById(3);
        $undiscountedTotal = $order->getTotal();
        $this->discounter->apply($order, true);

        $this->assertEquals(
            $order->getTotal(),
            $undiscountedTotal - (1.95 + 10.35)
        );
    }

    /**
     * @test
     */
    public function itAppliesHighestDiscount(): void
    {
        $order = $this->orderRepository->findById(3);
        $undiscountedTotal = $order->getTotal();
        $this->discounter->apply($order, false);

        $this->assertEquals(
            $order->getTotal(),
            $undiscountedTotal - 10.35
        );
    }

    /**
     * @test
     */
    public function itAppliesLowestDiscount(): void
    {
        $order = $this->orderRepository->findById(3);
        $undiscountedTotal = $order->getTotal();
        $this->discounter->apply($order, false, true);

        $this->assertEquals(
            $order->getTotal(),
            $undiscountedTotal - 1.95
        );
    }
}