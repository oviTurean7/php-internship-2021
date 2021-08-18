<?php

use App\Core\Router;

$router = new Router();

$router->get('/test', function($request){
    echo 'test route';
    var_dump($request);
});

$router->get('/test-controller', 'TestController@test');
$router->get('/', 'TestController@test');
$router->post('/cart', 'CartController@add');
$router->get('/cart', 'CartController@get');

return $router;
