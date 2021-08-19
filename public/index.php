<?php

require_once '../vendor/autoload.php';

setcookie('prevDate', date('m/d/Y h:i:s'));

if (isset($_COOKIE['prevDate'])) {
    //echo $_COOKIE['prevDate'];
    //unset($_COOKIE['prevDate']);
}

$request = new App\Core\Request();

$app = new App\Core\Application();

$app->handle($request);

