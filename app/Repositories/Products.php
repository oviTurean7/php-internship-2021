<?php

namespace App\Repositories;
global $products;
global $conn;
$sql = "SELECT * FROM `products`";
$result = $conn->query($sql);

$products = $result->fetch_all(MYSQLI_ASSOC);
//var_dump($products);

class Products
{

    static public function addProductsToDatabase () {
        global $conn;
        global $products;
        foreach($products as $product) {
            //var_dump($product);
            $stmt = $conn->prepare("INSERT  INTO products(name, units, price, description, url) VALUES (?, ?, ?, ?, ?)");

            $stmt->bind_param("sidss", $name, $units, $price, $description, $url);
            $name = $product['name'];
            $units = $product['units'];
            $price =  $product['price'];
            $description =  $product['description'];
            $url = $product['url'];
            $stmt->execute();
            $stmt->close();
        }
    }

    public function getProductById($productId) {


        //var_dump( $products);
        global $products;
        foreach($products as $product) {
            //var_dump($product);
            if($product['id'] == $productId) {
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