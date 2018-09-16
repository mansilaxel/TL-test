<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 13:58
 */

namespace Test\Database;

use Exception;
use Test\Domain\Product;

class ProductRepository
{
    /**
     * @var array
     */
    private $data;

    public function __construct()
    {
        $json = file_get_contents(__DIR__ .'/../../public/dummyData/products.json');
        $this->data = json_decode($json,true);
    }

    public function findById(string $id): Product
    {
        $index = array_search($id, array_column($this->data, 'id'));
        if (in_array($id, array_column($this->data, 'id'))){
            return Product::createFromJson($this->data[$index]);
        }
        throw new Exception('Product with id ' . $id .  ' does not exist');
    }
}