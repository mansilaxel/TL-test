<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 13:17
 */

namespace Test\Database;

use Exception;
use Test\Domain\Customer;

class CustomerRepository
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct()
    {
        $json = file_get_contents(__DIR__ .'/../../public/dummyData/customers.json');
        $this->data = json_decode($json,true);
    }

    /**
     * @param int $id
     * @return Customer
     * @throws Exception
     */
    public function findById(int $id): Customer
    {
        $index = array_search($id, array_column($this->data, 'id'));
        if (in_array($id, array_column($this->data, 'id'))){
            return Customer::createFromJson($this->data[$index]);
        }
        throw new Exception('Customer with id ' . $id .  ' does not exist');
    }
}