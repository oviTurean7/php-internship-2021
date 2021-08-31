<?php

namespace App\Repositories;
global $products;
global $conn;
$sql = "SELECT * FROM `products`";
$result = $conn->query($sql);

$products = $result->fetch_all(MYSQLI_ASSOC);
//var_dump($products);
//$products = (require_once dataPath() . "/products.php")['products'];

class Products
{

    public static function addProductsToDatabase ($productsToAdd) {
        global $conn;

        foreach($productsToAdd as $product) {
            //var_dump($product);
            //var_dump($product);
            //global $conn;
            //global $categories;
            $sql = "SELECT id FROM `categories`";
            $result = $conn->query($sql);
            $categories = $result->fetch_all(MYSQLI_NUM);;
            //var_dump($categories);
            //var_dump($_POST['categoryId']);
            if (!in_array(array(strval($product[5])), $categories))
            {
                echo "The category does not exist";
                http_response_code(404);
                return;
            }
            $stmt = $conn->prepare("INSERT  INTO products(name, units, price, description, url, category_id) VALUES (?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("sidssi", $name, $units, $price, $description, $url, $categoryId);
            $name = $product[0];
            $units = $product[1];
            $price =  $product[2];
            $description =  $product[3];
            $url = $product[4];
            $categoryId = $product[5];
            $stmt->execute();
            $stmt->close();
        }
    }

    public static function getProductById($productId) {


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