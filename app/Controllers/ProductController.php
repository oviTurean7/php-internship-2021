<?php

namespace App\Controllers;

use App\Repositories\Products;

class ProductController extends BaseController
{
    public function sortColumn() {
//        var_dump($_REQUEST);
//        echo json_decode($_POST['column']);
//        echo 'ddddddddddddddddddddddaaaaaaaaaaaaaa';
        $_SESSION['column'] = $_POST['column'];
        if (isset($_COOKIE['date'])) {
            var_dump( $_COOKIE['date']);
        }

        //echo $_POST['column'];
    }

    public function addProducts() {
        Products::addProductsToDatabase();
    }

    public function sortDirection() {
        if($_POST['direction'] === "down") {
            $_SESSION['direction'] = "desc";
        }
        else {
            $_SESSION['direction'] = "asc";
        }

        if (isset($_COOKIE['date'])) {
            var_dump( $_COOKIE['date']);
        }
    }

}