<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 13:22
 */

namespace Test\Tests\Database;

use PHPUnit\Framework\TestCase;
use Exception;
use Test\Database\CustomerRepository;

final class CustomerRepositoryTest extends TestCase
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    public function setUp()
    {
        $this->customerRepository = new CustomerRepository();
    }

    /**
     * @test
     */
    public function itCanFindCustomerById(): void
    {
        $result = $this->customerRepository->findById(1);

        $this->assertEquals(
            $result->getName(),
            'Coca Cola'
        );
    }

    /**
     * @test
     */
    public function itThrowsWhenFindCustomerByIdFails(): void
    {
        $this->expectException(Exception::class);
        $this->customerRepository->findById(9999999);
    }
}