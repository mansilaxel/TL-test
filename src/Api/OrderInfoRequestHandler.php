<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 17:07
 */

namespace Test\Api;

use Exception;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Slim\Http\Request;
use Slim\Http\Response;
use Test\Api\Transformers\OrderLineTransformer;
use Test\Database\OrderRepository;

class OrderInfoRequestHandler
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
        $id = $request->getAttribute('id');

        try {
            $data = $this->orderRepository->findById($id);

        } catch (Exception $exception) {
            return $response->withJson(
                [
                    'error' => $exception->getMessage(),
                ]
            );
        }

        return $response->withJson(
            [
                'data' =>
                    [
                        'id' => $data->getId(),
                        'customer-id' => $data->getCustomer()->getId(),
                        'items' => [
                            $this->fractal->createData(
                                new Collection($data->getOrderLines(), new OrderLineTransformer()))
                                ->toArray()
                        ],
                        'total' => $data->getTotal(),
                    ]
            ]
        );
    }
}