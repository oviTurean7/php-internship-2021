<?php

namespace App\Repositories;
global $products;
$products = (include_once dataPath() . "/products.php")['products'];

class Products
{



    public function getProductById($productId) {


        //var_dump( $products);
        global $products;
        foreach($products as $product) {
            //var_dump($product);
            if($product['id'] === $productId) {
                return $product;
            }
        }
        //echo $productId;
        return null;
    }

    public function getProducts() {

        global $products;
        usort($products, function ($elem1, $elem2) {

            $column = $_SESSION['column'];
            $direction = $_SESSION['direction'];
            if ($direction === "asc") {
                return ($elem1[$column] < $elem2[$column]) ? -1 : 1;
            }
            else {
                return ($elem1[$column] > $elem2[$column]) ? -1 : 1;
            }
        });
        return($products);
    }


}