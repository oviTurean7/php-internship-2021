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

    public function empty() {
        $this->addedToCart = [];
    }

    public function getCart() {


        return($this->addedToCart);
    }

    public function getTotalPrice() {

        $productsObject = new Products();
        $price = 0;

        foreach(array_keys($_SESSION['cart']->getCart()) as $id)
        {
            $addedProduct = $productsObject->getProductById($id);
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