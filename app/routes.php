<?php

use App\Core\Router;

$router = new Router();

$router->get('/test', function($request){
    echo 'test route';
    var_dump($request);
});

$router->get('/test-controller', 'TestController@test');
$router->get('/products', 'TestController@showProducts');
$router->post('/add-product', 'TestController@addProduct');
$router->get('/cart', 'TestController@showCart');
$router->put('/update-quantity', 'TestController@updateCart');
$router->delete('/remove-cart-product', 'TestController@removeCartProduct');

return $router;
