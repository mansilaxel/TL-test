<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 16/09/2018
 * Time: 16:26
 */

use Slim\App;
use Test\Api\OrderInfoRequestHandler;

require_once '../vendor/autoload.php';

$app = new App();

$app->any('/', function (){
    // Run app: \public>php -S localhost:8080  index.php
    return 'Hello world!' . '- /api/order/{id}';
});

$app->group('/api', function () {
    $this->any('/order/{id}', OrderInfoRequestHandler::class);
});

$app->run();