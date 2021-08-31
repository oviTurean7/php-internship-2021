<?php

namespace App\Controllers;

use App\Repositories\Cart;
use App\Repositories\Products;
use App\Validators\Validator;
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

            $final = ["error" => "The id needs to be a number", "code" => 400];
            echo json_encode($final);
            throw new Exception("The id needs to be a number");
        }
        if (isset($_COOKIE['date'])) {
            var_dump($_COOKIE['date']);
        }
        $final = ['items' => $_SESSION['cart']->getNumberOfItems(), "price" => $_SESSION['cart']->getTotalPrice(), "code" => 200];
        //var_dump($_SESSION['cart']->getTotalPrice());
        echo json_encode($final);
    }

    public function get()
    {

        $productsInCart = [];
        //$productsObject = new Products();
        $counter = 0;
        foreach (array_keys($_SESSION['cart']->getCart()) as $id) {
            $addedProduct = Products::getProductById($id);
            $addedProduct['quantity'] = $_SESSION['cart']->getCart()[$id];
            $productsInCart[$counter++] = $addedProduct;
        }
        echo json_encode($productsInCart);
    }

    public function update($id)
    {
        parse_str(file_get_contents("php://input"), $_PUT);

        $_SESSION['cart']->update($id, intval($_PUT['add']));
    }

    public function delete($id)
    {

        $_SESSION['cart']->delete($id);
    }

    public function empty()
    {

        $_SESSION['cart']->empty();
        var_dump($_SESSION['cart']);
        unset($_SESSION['cart']);
    }

    public function view()
    {
        $this->bladeResponse(array('Ioana' => 1), 'products/cart');

    }

    public function placeOrder() {
        $rules = [];
        foreach ($_POST as $key => $item) {
            if ($key === 'email')
            {
                $rules[$key] = 'email';
            }
            else
            {
                $rules[$key] = 'required';
            }
        }
        $validator = new Validator($rules, $_POST, []);
        if($validator->evaluate() === false)
        {
            echo implode (", ", $validator->getErrors());
            http_response_code(404);
            return;
        }
        $file_path = "http://php.local/uploads" . '/' . $_FILES['file']['name'];
        //var_dump( $file_path);
        FileController::add();
        //var_dump($_POST);
        echo $_SESSION['cart']->placeOrder($_POST, $file_path);

    }

}