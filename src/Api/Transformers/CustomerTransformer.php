<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 2/10/2018
 * Time: 10:04
 */

namespace Test\Api\Transformers;

use League\Fractal\TransformerAbstract;
use Test\Domain\Customer;

class CustomerTransformer extends TransformerAbstract
{
    /**
     * @param Customer $customer
     * @return array
     */
    public function transform(Customer $customer)
    {
        $data = [
            'id' => $customer->getId(),
            'name' => $customer->getName(),
            'revenue' => $customer->getRevenue(),
        ];

        return $data;
    }
}
