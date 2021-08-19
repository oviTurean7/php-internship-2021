<?php

namespace App\Controllers;

class TestController extends BaseController
{
    public function test()
    {
        $data = [
            'username' => 'andrei.test',
            'firstName' => 'Andrei',
            'lastName' => 'Arba',
            'products' => [
                [
                    'id' => 3,
                    'name' => 'item 1',
                    'units' => 2,
                    'price' => 150,
                    'description' => 'Best product on the market'
                ],
                [
                    'id' => 2,
                    'name' => 'item 2',
                    'units' => 200,
                    'price' => 5,
                    'description' => 'Just a cheap product with large stock'
                ],
                [
                    'id' => 1,
                    'name' => 'item 3',
                    'units' => 20,
                    'price' => 45,
                    'description' => 'An average, affordable product'
                ],
            ]
        ];


        $this->bladeResponse($data, 'products/list');
//        $this->jsonResponse($data);
//        $this->response($data, 'products/list');
    }

    public function showProducts()
    {
        $products = include_once basePath() . '/data/products.php';
        session_start();

        if (isset($_REQUEST['column']) && isset($_SESSION['columns'])) {
            usort($products, function ($p1, $p2) {
                $directionSort = $_SESSION['columns'][$_REQUEST['column']] == 'asc' ? -1 : 1;
                if ($p1[$_REQUEST['column']] < $p2[$_REQUEST['column']]) return $directionSort;

                return -1 * $directionSort;
            });
        }
        $this->bladeResponse(array('products' => $products), 'products/table');
    }

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

            echo json_encode($_SESSION['cartProducts']);
            exit();
        }
    }

    public function showCart() {
        session_start();

        if (isset($_SESSION['cartProducts'])) {
            $this->bladeResponse(array('products' => $_SESSION['cartProducts']), 'products/cart');
        }
    }

    private function updateSessionProduct($product) {
        session_start();

        $index = array_search($product['id'], array_column($_SESSION['cartProducts'], 'id'));
        $_SESSION['cartProducts'][$index] = $product;
    }

    public function updateCart() {
        if (isset($_POST['product'])) {
            $this->updateSessionProduct($_POST['product']);
            $this->showCart();
        }
    }

    public function removeCartProduct() {
        session_start();

        if (isset($_GET['id'])) {
            $index = array_search($_GET['id'], array_column($_SESSION['cartProducts'], 'id'));
            array_splice($_SESSION['cartProducts'], $index, 1);
            $this->showCart();
        }
    }
}
