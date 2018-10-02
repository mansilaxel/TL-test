<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 2/10/2018
 * Time: 11:31
 */

namespace Test\Api;

use Exception;
use Slim\Http\Request;
use Slim\Http\Response;
use Test\Database\OrderRepository;

class OrderLineRemoveRequestHandler
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
        $index = $request->getParam('index');

        try {
            $data = $this->orderRepository->findById($id);

        } catch (Exception $exception) {
            return $response->withJson(
                [
                    'error' => $exception->getMessage(),
                ]
            );
        }
        //Actual implementation to delete an item from given order = do some stuff in the repo . . .

        return $response->withJson($data->getOrderLines()[$index]->getProduct()->getDescription() . ' from order ' . $id . ' has been deleted. (THIS IS NOT PERSISTED!)')
            ->withStatus(200)
            ->withHeader('Access-Control-Allow-Origin','*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}
