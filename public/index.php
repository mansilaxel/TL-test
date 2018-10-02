<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 16:26
 */

use Slim\App;
use Test\Api\CustomerInfoRequestHandler;
use Test\Api\OrderLineAddRequestHandler;
use Test\Api\OrderInfoRequestHandler;
use Test\Api\OrderListRequestHandler;
use Test\Api\OrderPlaceRequestHandler;
use Test\Api\OrderLineRemoveRequestHandler;
use Test\Api\ProductInfoRequestHandler;
use Test\Api\ProductListRequestHandler;

require_once '../vendor/autoload.php';

$app = new App();

$app->any('/', function (){
    // Run app: \public>php -S localhost:8080  index.php
    return file_get_contents(__DIR__ .'/index.html');
});

$app->group('/api', function () {
    $this->any('/order/{id}', OrderInfoRequestHandler::class);
    $this->any('/orders', OrderListRequestHandler::class);
    $this->any('/products', ProductListRequestHandler::class);
    $this->any('/customer/{id}', CustomerInfoRequestHandler::class);
    $this->any('/product/{id}', ProductInfoRequestHandler::class);
    $this->any('/order/delete/{id}', OrderLineRemoveRequestHandler::class);
    $this->any('/order/add/{id}', OrderLineAddRequestHandler::class);
    $this->any('/placeOrder', OrderPlaceRequestHandler::class);
});

$app->run();
