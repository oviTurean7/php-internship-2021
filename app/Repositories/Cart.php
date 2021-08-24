<?php

namespace App\Repositories;

use App\Controllers\EmailController;
use App\Controllers\FileController;
use Illuminate\Support\Facades\Date;

class Cart
{
    protected array $addedToCart;

    public function __construct()
    {
        $this->addedToCart = [];
    }

    public function __call($method, $args)
    {
        return $this;
    }

    public function addToCart($productId) {

        if (!in_array($productId, array_keys($this->addedToCart)))
        {
            $this->addedToCart[$productId] = 1;
        }
        else {
            $this->addedToCart[$productId] += 1;
        }
        var_dump($this->addedToCart);
    }

    public function update($productId, $quantity) {
        $this->addedToCart[$productId] += $quantity;
        if ($this->addedToCart[$productId] <= 0) {
            unset($this->addedToCart[$productId]);
        }
    }

    public function delete($productId) {
        unset($this->addedToCart[$productId]);

    }

    public function placeOrder($data, $image_url) {
        if(count($this->addedToCart) === 0)
        {
            return;
        }
        $notEnough = $this->checkEnoughUnits();
        if (count($notEnough) ) {
            if(!empty($_SESSION['logged']) && !empty($_SESSION['email'])) {
                EmailController::orderCancelled($_SESSION['email'], $notEnough);
            }

            return;
        }

        global $conn;
        $stmt = $conn->prepare("INSERT  INTO orders(total_price, first_name, last_name, email, address, image_url) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("dsssss", $total_price, $first_name, $last_name, $email, $address, $url);
        $total_price = $_SESSION['cart']->getTotalPrice();
        $first_name = $data['firstName'];
        $last_name = $data['lastName'];
        $email = $data['email'];
        $address = $data['address'];
        $url = $image_url;
        $success = $stmt->execute();

        $stmt->close();


        $order_id = $conn->insert_id;

        var_dump($_SESSION['cart']->getCart());
        $items = false;
        foreach (array_keys($this->addedToCart) as $key) {
            echo "helllooooooooooo";
            $stmt = $conn->prepare("INSERT  INTO order_items(product_id, order_id, number_of_units, price) VALUES (?, ?, ?, ?)");

            $stmt->bind_param("iiii", $product_id, $order_id, $number_of_units, $price);
            $product_id = intval($key);

            $number_of_units = intval($this->addedToCart[$key]);
            $price = intval($number_of_units) * $this->getProductPrice($product_id) ;
            var_dump($product_id);
            var_dump($number_of_units);
            var_dump($price);
            $success = $stmt->execute();
            $items = true;
            $stmt->close();
        }

        $data['noOfItems'] = $this->getNumberOfItems();
        $data['totalPrice'] = $total_price;
        $data['date'] = date(' h:iA l jS \of F Y');
        FileController::append($data);
        echo "try me" . $_SESSION['email'] . "<br>";
        if (!empty($_SESSION['logged']) && !empty($_SESSION['email']) && $success && $items) {
            echo "I am doing email";
            EmailController::order($_SESSION['email'], $order_id, $total_price, $this->getNumberOfItems());
        }

    }

    public function empty() {
        $this->addedToCart = [];
    }

    public function getCart(): array
    {
        return($this->addedToCart);
    }

    public function getTotalPrice() {

        //$productsObject = new Products();
        $price = 0;
        //var_dump($_SESSION['cart']->getCart());
        //echo "calculating price ";

        foreach(array_keys($_SESSION['cart']->getCart()) as $id)
        {
            $addedProduct = Products::getProductById($id);
            //echo $id;
            //var_dump($addedProduct);
            $addedProduct['quantity'] = $this->addedToCart[$id];
            $price += intval($addedProduct['quantity']) * intval($addedProduct['price']);
            //echo $addedProduct['quantity'];

        }
        //echo $price;
        return $price;
    }

    public function getProductPrice($id): int
    {
        return intval(Products::getProductById($id)['price']);
    }


    public function getNumberOfItems() {
        $number = 0;
        foreach ($this->addedToCart as $quantity) {
            $number += $quantity;
        }
        return $number;
    }

    function checkEnoughUnits() {
        $notEnough = [];
        foreach(array_keys($_SESSION['cart']->getCart()) as $id)
        {
            $quantity = $this->addedToCart[$id];
            $product = Products::getProductById($id);
            $units = $product['units'];
            if ($quantity > $units) {
                $notEnough[] = $product['name'];
            }
        }
        return $notEnough;
    }



}