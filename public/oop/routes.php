<?php

use Oop\Core\Router;

$router = new Router();

$router->get('/test', function($request){
    echo 'test route';
    var_dump($request);
});

$router->get('/use', 'TrainingController@use');
$router->get('/class', 'TrainingController@className');
$router->get('/method', 'TrainingController@method');
$router->get('/namespace', 'TrainingController@namespace');



return $router;
