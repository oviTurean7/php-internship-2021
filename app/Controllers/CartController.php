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
        if (isset($_COOKIE['date'])) {
            var_dump( $_COOKIE['date']);
        }

    }

    public function get()
    {

        $productsInCart = [];
        $productsObject = new Products();
        $counter = 0;
        foreach(array_keys($_SESSION['cart']->getCart()) as $id)
        {
            $addedProduct = $productsObject->getProductById($id);
            $addedProduct['quantity'] = $_SESSION['cart']->getCart()[$id];
            $productsInCart[$counter++] = $addedProduct;
        }
        echo json_encode($productsInCart);
    }

    public function numberOfItems()
    {

    }

}