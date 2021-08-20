<?php

use App\Core\Router;

$router = new Router();

$router->get('/test', function($request){
    echo 'test route';
    var_dump($request);
});

$router->get('/index.php', 'TestController@test');
$router->get('/cart.php', 'TestController@cart');

return $router;
