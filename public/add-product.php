<?php
session_start();

$config = require_once '../config.php';

// TODO - work with the $_REQUEST and $_SESSION['cart'] and update accordingly

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    if (isset($_SESSION['_cart'])) {
        if (!in_array($id, $_SESSION['_cart']))
            array_push($_SESSION['_cart'], $id);
    }
    else {
        $_SESSION['_cart'] = array();
        array_push($_SESSION['_cart'], $id);
    }
}
//this is used to redirect the page back to index.php after adding product to cart
header('Location: '.$config['url'].'/products');
die();


