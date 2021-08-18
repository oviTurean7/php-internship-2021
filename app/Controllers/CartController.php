<?php

namespace App\Controllers;

use App\Repositories\Cart;
use App\Repositories\Products;
use Exception;


class CartController extends BaseController
{


    public function add()
    {

        $productId = json_decode($_POST['id']);

        if (is_int($productId)) {
            $_SESSION['cart']->addToCart($productId);
            //var_dump($_SESSION['cart']);

        } else {
            throw new Exception("The id needs to be a number");
        }


    }

    public function get()
    {

        $productsInCart = [];
        $productsObject = new Products();
        var_dump( $_SESSION['cart']->getCart());
        foreach(array_keys($_SESSION['cart']->getCart()) as $id)
        {
            $productsInCart[] = $productsObject->getProductById($id);
        }
        echo json_encode($productsInCart);
    }

    public function numberOfItems()
    {

    }
}