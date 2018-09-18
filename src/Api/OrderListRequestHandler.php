<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 18/09/2018
 * Time: 12:05
 */

namespace Test\Api;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Slim\Http\Request;
use Slim\Http\Response;
use Test\Api\Transformers\OrderTransformer;
use Test\Database\OrderRepository;

class OrderListRequestHandler
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var Manager
     */
    private $fractal;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->fractal = new Manager();
    }

    public function __invoke(Request $request, Response $response)
    {
        $data = $this->orderRepository->findAll();

        return $response->withJson(
            $this->fractal->createData(
                new Collection($data, new OrderTransformer($this->fractal)))
                ->toArray()
        );
    }
}