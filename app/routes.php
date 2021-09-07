<?php

use App\Core\Router;

$router = new Router();

$router->get('/test', function($request){
    echo 'test route';
    var_dump($request);
});

$router->get('/index.php', 'TestController@test');
$router->post('/upload.php', 'TestController@upload');
$router->get('/cart.php', 'TestController@cart');
$router->post('/delete-cart-item', 'TestController@deleteCartItem');
$router->get('/login-form.php', 'TestController@loginform');
$router->get('/register-form.php', 'TestController@registerform');
$router->post('/register.php', 'TestController@register');
$router->post('/login.php', 'TestController@login');
$router->post('/confirm.php', 'TestController@confirm');
$router->get('/categories.php', 'TestController@categories');

return $router;
