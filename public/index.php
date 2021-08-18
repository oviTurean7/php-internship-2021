<?php


use App\Repositories\Cart;

require_once '../vendor/autoload.php';

session_start();

$request = new App\Core\Request();

$app = new App\Core\Application();
if(session_id() == ''){
    //session has not started
    session_start();
    $_SESSION['cart'] = new Cart();
    //echo "here        hgry   ";
}


$app->handle($request);


