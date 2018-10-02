<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 2/10/2018
 * Time: 10:01
 */

namespace Test\Api;

use Exception;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Slim\Http\Request;
use Slim\Http\Response;
use Test\Api\Transformers\CustomerTransformer;
use Test\Database\CustomerRepository;

class CustomerInfoRequestHandler
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @var Manager
     */
    private $fractal;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepository();
        $this->fractal = new Manager();
    }

    public function __invoke(Request $request, Response $response)
    {
        $id = $request->getAttribute('id');

        try {
            $data = $this->customerRepository->findById($id);

        } catch (Exception $exception) {
            return $response->withJson(
                [
                    'error' => $exception->getMessage(),
                ]
            );
        }

        return $response->withJson(
            $this->fractal->createData(
                new Item($data, new CustomerTransformer()))
                ->toArray()
        )
        ->withHeader('Access-Control-Allow-Origin','*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}
