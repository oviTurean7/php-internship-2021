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
$router->post('/submit-buyer-info', 'TestController@validateBuyer');
$router->get('/testDB', 'TestController@testDB');
$router->get('/show-users', 'TestController@showUsers');
$router->get('/login', 'AccountController@showLoginForm');
$router->get('/validate-login', 'AccountController@checkLoginData');
$router->get('/home', 'AccountController@showHome');
$router->get('/register-form', 'AccountController@showRegister');
$router->get('/register', 'AccountController@checkRegisterData');

return $router;
