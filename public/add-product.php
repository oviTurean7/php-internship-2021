<?php
session_start();
$config = require_once '../config.php';

header('Access-Control-Allow-Origin: http://internship.local');
header('Content-Type: application/json');

if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!in_array($_GET['pId'], $_SESSION['cart']))
    $_SESSION['cart'][] = $_GET['pId'];


// TODO - work with the $_REQUEST and $_SESSION['cart'] and update accordingly

//this is used to redirect the page back to index.php after adding product to cart
header('Location: ' . $config['url']);
die();


