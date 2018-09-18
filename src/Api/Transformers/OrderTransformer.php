<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 17:06
 */

namespace Test\Api\Transformers;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Test\Domain\Order;

class OrderTransformer extends TransformerAbstract
{
    /**
     * @var Manager
     */
    private $fractal;

    /**
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * @param Order $order
     * @return array
     */
    public function transform(Order $order)
    {
        $data = [
            'id' => $order->getId(),
            'customer-id' => $order->getCustomer()->getId(),
            'items' => $this->fractal->createData(
                new Collection($order->getOrderLines(), new OrderLineTransformer()))
                ->toArray()
            ,
            'discounts' => $this->fractal->createData(
                new Collection($order->getDiscounts(), new DiscountTransformer()))
                ->toArray()
            ,
            'total' => $order->getTotal(),
        ];

        return $data;
    }
}