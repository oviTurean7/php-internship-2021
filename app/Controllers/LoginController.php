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
        $pattern = '/(.+@.+\..+)/';
        $subject = 'a@m.c';
        $res = preg_match($pattern, $subject);
        if ($res === 0) {
                echo 'Incorrect email format';
                http_response_code(404);
                return;
        }
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

            $_SESSION['logged'] = true;
            $_SESSION['email'] = $email;
            session_start();
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

    public function logout() {
        unset($_SESSION['logged']);
        unset($_SESSION['email']);
        session_destroy();

    }

    public function changePasswordView() {
        $this->bladeResponse(array('Ioana' => 1), 'products/password');
        //$token = $_GET['token'];

    }

    public function changePassword() {
        $token = $_GET['token'];
        //$this->bladeResponse(array('Ioana' => 1), 'products/password');
    }

    public function forgotPassword() {
        //EmailController::passwordRecovery($_POST['email'], SignupController::tokenize(['email' => $_POST['email'], 'recovery' => 'true']));
        var_dump(SignupController::decode(strval('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImlvbW8yMDEwQHlhaG9vLmNvbSJ9.0EpFpXYBAJCAz8UaCDKek4qrr0Ppe_F_KRsMAMcLHMg'))->email);
    }

    public function emailView() {
        $this->bladeResponse(array('Ioana' => 1), 'products/email');
    }


    public function view()
    {
        $this->bladeResponse(array('Ioana' => 1), 'products/login');

    }

}