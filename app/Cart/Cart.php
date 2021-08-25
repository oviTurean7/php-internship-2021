<?php

namespace App\Cart;

interface Cart
{
    public function addToCart($productId);

    public function update($productId, $quantity);

    public function delete($productId);

    public function placeOrder($data, $image_url);

    public function empty();

    public function getCart(): array;

    public function getTotalPrice();

    public function getProductPrice($id): int;



    public function getNumberOfItems();

    function checkEnoughUnits();

}