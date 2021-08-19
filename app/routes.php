<?php

use App\Core\Router;

$router = new Router();

$router->get('/test', function($request){
    echo 'test route';
});

$router->get('/test-controller', 'TestController@test');
$router->get('/products', 'TestController@showProducts');
$router->post('/add-product', 'TestController@addProduct');
$router->get('/cart', 'TestController@showCart');
$router->post('/update-quantity', 'TestController@updateCart');
$router->get('/remove-cart-product', 'TestController@removeCartProduct');

return $router;
