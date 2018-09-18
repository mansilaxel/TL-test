<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 14:12
 */

namespace Test\Tests\Database;


use Exception;
use PHPUnit\Framework\TestCase;
use Test\Database\CustomerRepository;
use Test\Database\OrderRepository;
use Test\Database\ProductRepository;

final class OrderRepositoryTest extends TestCase
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function setUp()
    {
        $this->orderRepository = new OrderRepository();
        $this->productRepository = new ProductRepository();
        $this->customerRepository = new CustomerRepository();
    }

    /**
     * @test
     */
    public function itCanFindOrderById(): void
    {
        $result = $this->orderRepository->findById(3);

        $this->assertEquals(
            $result->getOrderLines()[1]->getProduct()->getDescription(),
            'Electric screwdriver'
        );
    }

    /**
     * @test
     */
    public function itThrowsWhenFindOrderByIdFails(): void
    {
        $this->expectException(Exception::class);
        $this->orderRepository->findById(999999);
    }

    /**
     * @test
     */
    public function itFindsAllOrders(): void
    {
        $result = $this->orderRepository->findAll();

        $this->assertEquals(
            count($result),
            3
        );
    }
}