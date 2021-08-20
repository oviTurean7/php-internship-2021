<?php

namespace App\Controllers;

use App\Repositories\Cart;
use App\Repositories\Products;
use Error;
use Exception;


class LoginController extends BaseController
{

    /**
     * @throws Exception
     */
    public function login() {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        global $db;
        global $conn;

        $sql = "SELECT email, password FROM users WHERE email = $email AND password = $password";
        $result = $conn->query($sql);
        var_dump ($result);
        if ($result == true) {
            echo "yes";
        } else {
            echo "no";
            http_response_code(404);
        }

    }


    public function view()
    {
        $this->bladeResponse(array('Ioana' => 1), 'products/login');

    }

}