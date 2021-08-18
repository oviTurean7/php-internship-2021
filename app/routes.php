<?php

use App\Core\Router;

$router = new Router();

$router->get('/test', function($request){
    echo 'test route';
    var_dump($request);
});

$router->get('/test-controller', 'TestController@test');

return $router;
