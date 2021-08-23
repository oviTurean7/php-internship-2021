<?php

namespace App\Repositories;

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

    public function placeOrder() {
        global $conn;
        $stmt = $conn->prepare("INSERT  INTO orders(total_price) VALUES (?)");

        $stmt->bind_param("d", $total_price);
        $total_price = $this->getTotalPrice();
        $stmt->execute();

        $stmt->close();

        $stmt = $conn->prepare("INSERT  INTO order_items(product_id, order_id, number_of_units, price) VALUES (?, ?, ?, ?)");

        $stmt->bind_param("iiii", $product_id, $order_id, $number_of_units, $price);
        $order_id = $conn->insert_id;
        foreach (array_keys($this->addedToCart) as $key) {
            $product_id = intval($key);

            $number_of_units = intval($this->addedToCart[$key]);
            $price = 50;
            $stmt->execute();
        }

        $stmt->close();

    }

    public function empty() {
        $this->addedToCart = [];
    }

    public function getCart(): array
    {
        return($this->addedToCart);
    }

    public function getTotalPrice() {

        $productsObject = new Products();
        $price = 0;
        //var_dump($_SESSION['cart']->getCart());
        foreach(array_keys($_SESSION['cart']->getCart()) as $id)
        {
            $addedProduct = $productsObject->getProductById($id);
            echo "here";
            var_dump($addedProduct);
            $addedProduct['quantity'] = $_SESSION['cart']->getCart()[$id];
            $price += intval($addedProduct['quantity']) * intval($addedProduct['price']);
            //echo $addedProduct['quantity'];
        }
        return $price;
    }


    public function getNumberOfItems() {
        $number = 0;
        foreach ($this->addedToCart as $quantity) {
            $number += $quantity;
        }
        return $number;
    }


}