<?php

namespace App\Controllers;

class ProductController extends BaseController
{
    public function sortColumn() {
        $_SESSION['column'] = $_POST['column'];
        if (isset($_COOKIE['date'])) {
            var_dump( $_COOKIE['date']);
        }
        //echo $_POST['column'];
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