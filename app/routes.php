<?php

use App\Core\Router;

$router = new Router();

$router->get('/test', function($request){
    echo 'test route';
});

$router->get('/test-controller', 'TestController@test');
$router->get('/products', 'ProductsController@showProducts');
$router->post('/add-product', 'ProductsController@addProduct');
$router->get('/cart', 'ProductsController@showCart');
$router->post('/update-quantity', 'ProductsController@updateCart');
$router->get('/remove-cart-product', 'ProductsController@removeCartProduct');
$router->post('/submit-buyer-info', 'ProductsController@validateBuyer');
$router->get('/testDB', 'TestController@testDB');
$router->get('/show-users', 'TestController@showUsers');
$router->get('/login', 'AccountController@showLoginForm');
$router->get('/validate-login', 'AccountController@checkLoginData');
$router->get('/home', 'AccountController@showHome');
$router->get('/register-form', 'AccountController@showRegister');
$router->get('/register', 'AccountController@checkRegisterData');
$router->get('/confirm', 'AccountController@confirmMail');

return $router;
