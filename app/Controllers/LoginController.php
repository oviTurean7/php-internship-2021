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

        $sql = "SELECT email, password, confirmed FROM users WHERE email =  '$email' AND password = '$password'";
        //echo $sql . "\n";

        $result = $conn->query($sql);

        if ($result->num_rows !== 0) {
            if($result->fetch_assoc()['confirmed'] == 0) {
                echo 'Please confirm your account';
                http_response_code(404);
                return;
            }

            $_COOKIE['logged'] = true;
            echo "Success";
        } else {
            $sql = "SELECT email, password FROM users WHERE email =  '$email'";
            //echo $sql . "\n";

            $result = $conn->query($sql);
            //var_dump ($result);
            if ($result->num_rows !== 0) {
                echo 'Wrong password';
                http_response_code(404);
            }
            else {
                echo 'No such user';
                http_response_code(404);
            }

        }

    }


    public function view()
    {
        $this->bladeResponse(array('Ioana' => 1), 'products/login');

    }

}