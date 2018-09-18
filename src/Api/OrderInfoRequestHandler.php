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
use League\Fractal\Resource\Item;
use Slim\Http\Request;
use Slim\Http\Response;
use Test\Api\Transformers\OrderTransformer;
use Test\Database\OrderRepository;
use Test\Domain\Discount\Discounter;

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

    /**
     * @var Discounter
     */
    private $discounter;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->fractal = new Manager();
        $this->discounter = new Discounter();
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
        if (!is_null($request->getParam('all')) && count($request->getParams()) == 1) {
            $this->discounter->apply($data, true);
        }
        if (!is_null($request->getParam('low')) && count($request->getParams()) == 1) {
            $this->discounter->apply($data, false, true);
        }
        if (!is_null($request->getParam('high')) && count($request->getParams()) == 1) {
            $this->discounter->apply($data, false);
        }


        return $response->withJson(
            $this->fractal->createData(
                new Item($data, new OrderTransformer($this->fractal)))
                ->toArray()
            );
    }
}