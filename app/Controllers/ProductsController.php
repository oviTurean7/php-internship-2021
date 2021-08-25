<?php

namespace App\Controllers;

use App\Cart\Cart;
use App\DAL\DBConnection;

require_once basePath() . '/vendor/autoload.php';
require_once basePath() . '/App/Cart/Cart.php';

class ProductsController extends BaseController
{
    private $cart;

    public function __construct()
    {
        parent::__construct();
        $this->cart = new Cart();
    }

    private function getProducts() {
        $conn = getConnection();
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
        session_start();
        $products = $this->getProducts();

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
        $this->cart->addProduct();

        echo json_encode($_SESSION['cartProducts']);
        exit();
    }

    public function showCart() {
        $products = $this->cart->getProducts();
        if ($products) {
            $this->bladeResponse(array('products' => $products), 'products/cart');
        }
    }

    public function updateCart() {
        $this->cart->updateCart();
        $this->showCart();
    }

    public function removeCartProduct() {
        $this->cart->removeProduct();
        $this->showCart();
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
            ->setTo($_SESSION['user']['email'])
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
        $queryInsertOrderItems = "";
        $totalCost = 0;
        $cartProducts = $this->cart->getProducts();

        foreach ($cartProducts as $orderItem) {
            $prodID = $orderItem['id'];
            $query = "SELECT units from `products` WHERE id = $prodID";
            $dbConnection = new DBConnection();
            $dbProduct = $dbConnection->getSingleData($query);

            if ($dbProduct['units'] < $orderItem['quantity']) {
                $this->sendEmail("Insufficient stock for product: " . $orderItem['name']);
                die('Stock not enough');
            } else {
                $totalCost += $orderItem['quantity'] * $orderItem['price'];
            }
        }
        $dbConnection = new DBConnection();
        $date = date('m/d/Y h:i:s a', time());
        $query = "INSERT INTO `orders`(date, total_price) VALUES('$date', $totalCost)";
        $result = $dbConnection->insertData($query);
        $orderID = 0;

        if ($result) {
            $orderID = $dbConnection->insert_id;
        }

        foreach ($cartProducts as $orderItem) {
            $dbConnection = new DBConnection();

            $values = array_values($orderItem);
            $itemPrice = $values[5] * $values[2];

            $queryInsertOrderItems .= "INSERT INTO `order_items`(product_id, units_num, price, order_id) VALUES($values[0], $values[5], $itemPrice, $orderID);";
            $dbConnection->insertMultipleData($queryInsertOrderItems);
        }
        $this->sendEmail("Order placed successfully");

        session_start();
        unset($_SESSION['cartProducts']);
    }


}