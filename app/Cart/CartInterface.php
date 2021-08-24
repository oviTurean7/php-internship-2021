<?php

namespace App\Cart;

interface CartInterface {
    public function addProduct();

    public function removeProduct();

    public function updateCart();

    public function getProducts();
}