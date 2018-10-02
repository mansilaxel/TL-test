<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 2/10/2018
 * Time: 10:08
 */

namespace Test\Api\Transformers;

use League\Fractal\TransformerAbstract;
use Test\Domain\Product;

class ProductTransformer extends TransformerAbstract
{
    /**
     * @param Product $product
     * @return array
     */
    public function transform(Product $product)
    {
        $data = [
            'id' => $product->getId(),
            'description' => $product->getDescription(),
            'category' => $product->getCategory(),
            'price' => $product->getPrice(),
        ];

        return $data;
    }
}
