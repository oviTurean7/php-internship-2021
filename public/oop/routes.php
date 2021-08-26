<?php

use Oop\Core\Router;

$router = new Router();





$router->get('/', 'TestController@test');
$router->get('/use', 'TrainingController@use');
$router->get('/class', 'TrainingController@className');
$router->get('/method', 'TrainingController@method');
$router->get('/namespace', 'TrainingController@namespace');



return $router;
