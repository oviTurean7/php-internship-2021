<?php


use App\Repositories\Cart;

require_once '../vendor/autoload.php';

session_start();

$request = new App\Core\Request();

$app = new App\Core\Application();
//session_destroy();
$_COOKIE['date'] = new DateTime();
//
//if (session_id() == '') {
//    //session has not started
//
//    session_start();
//    echo "here";
//
//
//    //echo "here        hgry   ";
//}

if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
    $_SESSION['column'] = "name";
    $_SESSION['direction'] = "asc";
}
unset($_COOKIE['date']);

$app->handle($request);


