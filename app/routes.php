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
$router->get('/login/forgot-password', 'LoginController@emailView');
$router->post('/login/forgot-password', 'LoginController@forgotPassword');
$router->post('/login', 'LoginController@login');
$router->post('/logout', 'LoginController@logout');
$router->get('/signup', 'SignupController@view');
$router->post('/signup', 'SignupController@signup');
$router->get('/regex', 'RegexController@solve');
$router->get('/categories', 'CategoryController@view');
$router->get('/categories/all', 'CategoryController@index');
$router->post('/categories', 'CategoryController@create');
$router->get('/categories/{id}', 'CategoryController@show');
$router->put('/categories/{id}', 'CategoryController@update');
$router->delete('/categories/{id}', 'CategoryController@delete');
$router->get('/products', 'ProductController@view');
$router->get('/products/export', 'ProductController@export');
$router->get('/products/all', 'ProductController@index');
$router->post('/products', 'ProductController@create');
$router->get('/products/{id}', 'ProductController@show');
$router->put('/products/{id}', 'ProductController@update');
$router->delete('/products/{id}', 'ProductController@delete');
$router->post('/products/import', 'ProductController@import');

$router->get('/confirm?token={test}', 'ConfirmController@confirm');
$router->get('/recover?token={test}', 'LoginController@changePasswordView');
$router->post('/recover?token={test}', 'LoginController@changePassword');
$router->get('/{file}', 'ProductController@download');



return $router;
