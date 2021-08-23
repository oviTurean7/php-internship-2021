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
$router->get('/cart/all', 'CartController@get');
$router->post('/product/sort/column', 'ProductController@sortColumn');
$router->post('/product/sort/direction', 'ProductController@sortDirection');
$router->post('/file', 'FileController@add');
$router->get('/cart', 'CartController@view');
$router->put('/cart/{id}', 'CartController@update');
$router->delete('/cart/{id}', 'CartController@delete');
$router->delete('/cart', 'CartController@empty');
$router->post('/cart/order', 'CartController@placeOrder');
$router->get('/login', 'LoginController@view');
$router->post('/login', 'LoginController@login');
$router->get('/signup', 'SignupController@view');
$router->post('/signup', 'SignupController@signup');
$router->get('/regex', 'RegexController@solve');
//$router->get('/prodsToDb', 'ProductController@addProducts');
$router->get('/confirm?token={test}', 'ConfirmController@confirm');



return $router;
