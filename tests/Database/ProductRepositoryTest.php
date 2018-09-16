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
use Test\Database\ProductRepository;

final class ProductRepositoryTest extends TestCase
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function setUp()
    {
        $this->productRepository = new ProductRepository();
    }

    /**
     * @test
     */
    public function itCanFindProductById(): void
    {
        $result = $this->productRepository->findById('B101');

        $this->assertEquals(
            $result->getPrice(),
            4.99
        );
    }

    /**
     * @test
     */
    public function itThrowsWhenFindProductByIdFails(): void
    {
        $this->expectException(Exception::class);
        $this->productRepository->findById('random****');
    }
}