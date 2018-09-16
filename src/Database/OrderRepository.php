<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 14:07
 */

namespace Test\Database;

use Exception;
use Test\Domain\Customer;
use Test\Domain\Order;
use Test\Domain\OrderLine;

class OrderRepository
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct()
    {
        $this->data[] = json_decode(file_get_contents(__DIR__ .'/../../public/dummyData/order1.json'),true);
        $this->data[] = json_decode(file_get_contents(__DIR__ .'/../../public/dummyData/order2.json'),true);
        $this->data[] = json_decode(file_get_contents(__DIR__ .'/../../public/dummyData/order3.json'),true);
        $this->customerRepository = new CustomerRepository();
        $this->productRepository = new ProductRepository();
    }

    /**
     * @param int $id
     * @return Order
     * @throws Exception
     */
    public function findById(int $id): Order
    {
        if (in_array($id, array_column($this->data, 'id'))){
            $index = array_search($id, array_column($this->data, 'id'));
            $customer = $this->findCustomer($this->data[$index]['customer-id']);
            $orderLines = $this->findOrderLines($this->data[$index]['items']);

            return Order::createFromJson($this->data[$index], $customer, $orderLines);
        }
        throw new Exception('Order with id ' . $id .  ' does not exist');
    }

    /**
     * @param string $id
     * @return Customer
     * @throws Exception
     */
    private function findCustomer(string $id): Customer
    {
        return $this->customerRepository->findById($id);
    }

    /**
     * @param array $orderLines
     * @return array
     * @throws Exception
     */
    private function findOrderLines(array $orderLines): array
    {
        $items = [];
        foreach ($orderLines as $item)
        {
            $product = $this->productRepository->findById(($item['product-id']));
            $items[] = new OrderLine($product, $item['quantity']);
        }
        return $items;
    }
}