<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 17:00
 */

namespace Test\Api\Transformers;

use League\Fractal\TransformerAbstract;;
use Test\Domain\OrderLine;

class OrderLineTransformer extends TransformerAbstract
{
    /**
     * @param OrderLine $orderLine
     * @return array
     */
    public function transform(OrderLine $orderLine)
    {
        $data = [
            'product-id' => $orderLine->getProduct()->getId(),
            'quantity' => $orderLine->getQuantity(),
            'unit-price"' => $orderLine->getProduct()->getPrice(),
            'total' => $orderLine->getTotal(),
        ];

        return $data;
    }
}