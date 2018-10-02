<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 2/10/2018
 * Time: 10:09
 */

namespace Test\Api;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Slim\Http\Request;
use Slim\Http\Response;
use Test\Api\Transformers\ProductTransformer;
use Test\Database\ProductRepository;

class ProductListRequestHandler
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var Manager
     */
    private $fractal;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->fractal = new Manager();
    }

    public function __invoke(Request $request, Response $response)
    {
        $data = $this->productRepository->findAll();

        return $response->withJson(
            $this->fractal->createData(
                new Collection($data, new ProductTransformer()))
                ->toArray()
        )
        ->withHeader('Access-Control-Allow-Origin','*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}
