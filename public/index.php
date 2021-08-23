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
//session_destroy();
if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = new Cart();
}
if (empty($_SESSION['column'] = "name")) {
    $_SESSION['column'] = "name";
}
if (empty($_SESSION['direction'])) {
    $_SESSION['direction'] = "asc";
}

unset($_COOKIE['date']);

global $conn;
$db = (include basePath() . "\config.php")['database'];


$conn =  new mysqli($db['server'], $db['username'], $db['password'], $db['name']
);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//include_once databasePath() . "/mysqli-procedural.php";
//include_once databasePath() . "/mysqli-oop.php";
//include_once databasePath() . "/pdo.php";

$app->handle($request);


