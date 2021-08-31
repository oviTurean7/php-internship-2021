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
$router->get('/submit-buyer-info', 'ProductsController@validateBuyer');
$router->get('/testDB', 'TestController@testDB');
$router->get('/show-users', 'TestController@showUsers');
$router->get('/login', 'AccountController@showLoginForm');
$router->get('/validate-login', 'AccountController@checkLoginData');
$router->get('/home', 'AccountController@showHome');
$router->get('/register-form', 'AccountController@showRegister');
$router->get('/register', 'AccountController@checkRegisterData');
$router->get('/confirm', 'AccountController@confirmMail');
$router->get('/root-categories', 'CategoryController@root');
$router->get('/categories', 'CategoryController@index');
$router->post('/categories/editor', 'CategoryController@editorIndex');
$router->get('/root-products', 'ProductsResourceController@root');
$router->get('/products-editor', 'ProductsResourceController@index');
$router->post('/products-editor/editor', 'ProductsResourceController@editorIndex');
$router->get('/products-editor/export', 'ExcelController@export');
$router->get('/products-editor/import-template', 'ExcelController@importTemplate');
$router->post('/products-editor/import-data', 'ExcelController@importData');

return $router;
