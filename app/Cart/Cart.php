<?php


namespace App\Cart;

global $configDB;
$configDB = require_once basePath() . '/configDB.php';
require_once basePath() . '/vendor/autoload.php';

class Cart implements CartInterface {

    public function addProduct() {
        if (isset($_POST['product'])) {
            session_start();
            $product = $_POST['product'];

            if (isset($_SESSION['cartProducts'])) {
                if (!in_array($product, $_SESSION['cartProducts']))
                    array_push($_SESSION['cartProducts'], $product);
            }
            else {
                $_SESSION['cartProducts'] = array();
                array_push($_SESSION['cartProducts'], $product);
            }
        }
    }

    public function updateCart() {
        if (isset($_POST['product'])) {
            session_start();
            $index = array_search($_POST['product']['id'], array_column($_SESSION['cartProducts'], 'id'));
            $_SESSION['cartProducts'][$index] = $_POST['product'];
        }
    }

    public function removeProduct() {
        session_start();
        if (isset($_GET['id'])) {
            $index = array_search($_GET['id'], array_column($_SESSION['cartProducts'], 'id'));
            array_splice($_SESSION['cartProducts'], $index, 1);
        }
    }

    public function getProducts() {
        $conn = $this->getConnection();
        $query = "SELECT * FROM `products`";
        $result = $conn->query($query);
        $products = [];
        if ($result->num_rows > 0) {
            while($product = $result->fetch_assoc()) {
                $products[] = $product;
            }
        }

        return $products;
    }
}