<?php
session_start();
require_once '../vendor/autoload.php';

$request = new App\Core\Request();

$app = new App\Core\Application();

$app->handle($request);

if (empty($_SESSION['columns'])) {
    $_SESSION['columns'] = array('name'=>'asc', 'units'=>'asc', 'price'=>'asc');
}



