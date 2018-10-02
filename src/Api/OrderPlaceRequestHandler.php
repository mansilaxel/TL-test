<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 2/10/2018
 * Time: 12:05
 */

namespace Test\Api;

use Slim\Http\Request;
use Slim\Http\Response;

class OrderPlaceRequestHandler
{
    public function __construct()
    {
    }

    public function __invoke(Request $request, Response $response)
    {
        // Validate the incoming request.
        // Build or update (first find requested one in the repository) the Order.
        // Persist the Order through the repository.

        // Do some fake stuff.

        $message = 'Order is placed.';
        $status = 200;
        if (rand(0,3) > 2) {
            $message = 'Order is not placed for weird reasons.';
            $status = 400;
        }

        return $response->withJson($message)
            ->withStatus($status)
            ->withHeader('Access-Control-Allow-Origin','*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}
