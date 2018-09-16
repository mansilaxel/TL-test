<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 17:44
 */

namespace Test\Api\Transformers;

use League\Fractal\TransformerAbstract;
use Test\Domain\Discount\Discount;

class DiscountTransformer extends TransformerAbstract
{
    /**
     * @param Discount $discount
     * @return array
     */
    public function transform(Discount $discount)
    {
        $data = [
            'amount' => $discount->getAmount(),
            'description' => $discount->getDescription(),
        ];

        return $data;
    }
}