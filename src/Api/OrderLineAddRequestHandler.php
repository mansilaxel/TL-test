<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 2/10/2018
 * Time: 10:20
 */

namespace Test\Api;

use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Test\Database\OrderRepository;

class OrderLineAddRequestHandler
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function __invoke(Request $request, Response $response)
    {
        $id = $request->getAttribute('id');
        $addedOrderLineId = $request->getParam('product-id');

        try {
            $data = $this->orderRepository->findById($id);

        } catch (Exception $exception) {
            return $response->withJson(
                [
                    'error' => $exception->getMessage(),
                ]
            );
        }
        //Actual implementation to add an item to given order = do some stuff in the repo . . .

        return $response->withJson($addedOrderLineId . ' has been added to order ' . $id  . '(THIS IS NOT PERSISTED!)')
            ->withStatus(200)
            ->withHeader('Access-Control-Allow-Origin','*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}
