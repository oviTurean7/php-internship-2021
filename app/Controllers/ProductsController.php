<?php

namespace App\Controllers;

global $configDB;
$configDB = require_once basePath() . '/configDB.php';
require_once basePath() . '/vendor/autoload.php';

class ProductsController extends BaseController
{
    private function getConnection() {
        global $configDB;

        $conn = new \mysqli($configDB['database']['server'], $configDB['database']['user'], $configDB['database']['password'], $configDB['database']['name']);
        if (!$conn) {
            die('Connection failed:' . $conn->connect_error);
        }
        return $conn;
    }

    private function getProducts() {
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

    public function showProducts() {
        $products = $this->getProducts();
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

    public function validateBuyer() {
        //some validation
        $this->proceed();
    }

    private function sendEmail($body) {
        global $config;

        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('robert3paul')
            ->setPassword($config['mailPassword']);

        $mailer = new \Swift_Mailer($transport);
// Create a message
        $message = (new \Swift_Message('First email'))
            ->setFrom(['robert3paul@gmail.com' => 'Robert Gherghel'])
            ->setTo([$_SESSION['user']['email']])
            ->setBody($body);
// Send the message
        try {
            $result = $mailer->send($message);
        }
        catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }

    private function proceed()
    {
        session_start();
        $queryInsertOrderItems = "";
        $totalCost = 0;

        foreach ($_SESSION['cartProducts'] as $orderItem) {
            $conn = $this->getConnection();
            $prodID = $orderItem['id'];
            $query = "SELECT units from `products` WHERE id = $prodID";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $dbProduct = $result->fetch_assoc();
                if ($dbProduct['units'] < $orderItem['quantity']) {
                    $this->sendEmail("Insufficient stock for product: " . $orderItem['name']);
                    die('Stock not enough');
                } else {
                    $totalCost += $orderItem['quantity'] * $orderItem['price'];
                }
            }
        }
        $conn = $this->getConnection();
        $date = date('m/d/Y h:i:s a', time());
        $query = "INSERT INTO `orders`(date, total_price) VALUES('$date', $totalCost)";
        $result = $conn->query($query);
        $orderID = 0;

        if ($result) {
            $orderID = $conn->insert_id;
        }

        foreach ($_SESSION['cartProducts'] as $orderItem) {
            $conn = $this->getConnection();

            $values = array_values($orderItem);
            $itemPrice = $values[5] * $values[2];

            $queryInsertOrderItems .= "INSERT INTO `order_items`(product_id, units_num, price, order_id) VALUES($values[0], $values[5], $itemPrice, $orderID);";
            $conn->multi_query($queryInsertOrderItems);
        }
        $this->sendEmail("Order placed successfully");
        unset($_SESSION['cartProducts']);
    }


}