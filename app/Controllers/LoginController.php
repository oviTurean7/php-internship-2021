<?php

namespace App\Controllers;

use App\Exceptions\TestException;
use App\Repositories\Cart;
use App\Repositories\Products;
use App\Validators\Validator;
use Error;
use Exception;


class LoginController extends BaseController
{


    /**
     * @throws Exception
     */
    public function login() {


        /*

        set_exception_handler(function ($exception) {
            $msg = $exception->getMessage();
            echo "You have reached me: $msg";
            http_response_code(404);
           var_dump( error_log("$msg"));
        }); // no, it is not reached at 9, but it is reached at 10



        /*
        $pattern = '/(.+@.+\..+)/';
        $res = preg_match($pattern, $email);

        if ($res === 0) {
            throw new TestException('Incorrect email format');

        }*/

        /*
        try {

        }
        catch (Exception $ex) {
            echo "General exception: " . $ex->getMessage();
            http_response_code(404);
            return;
        } /* the first one, it goes to the first one that matches.
        catch (TestException $ex) {
            echo $ex->getMessage();
            http_response_code(404);
            return;
        }
    */
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
        $token = $_POST['token'];
        $newPassword = md5($_POST['password']);
        $decoded = (SignupController::decode($token));
        if ($decoded->recovery !== "true")
            return;
        $email = (SignupController::decode($token))->email;
        global $conn;
        $sql = "UPDATE users SET password='$newPassword' WHERE email =  '$email'";
        //echo $sql . "\n";

        $result = $conn->query($sql);
        echo $result;

        //$this->bladeResponse(array('Ioana' => 1), 'products/password');
    }

    public function forgotPassword() {
        $email = $_POST['email'];
        global $conn;
        $sql = "SELECT email, password FROM users WHERE email =  '$email'";
        //echo $sql . "\n";

        $result = $conn->query($sql);
        //var_dump ($result);
        if ($result->num_rows !== 0) {
            echo 'has email';
            //http_response_code(404);
        }
        else {
            echo 'No such user';
            //http_response_code(404);
            return;
        }
        EmailController::passwordRecovery($_POST['email'], SignupController::tokenize(['email' => $_POST['email'], 'recovery' => 'true']));
        //var_dump(SignupController::decode(strval('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImlvbW8yMDEwQHlhaG9vLmNvbSJ9.0EpFpXYBAJCAz8UaCDKek4qrr0Ppe_F_KRsMAMcLHMg'))->email);
    }

    public function emailView() {
        $this->bladeResponse(array('Ioana' => 1), 'products/email');
    }


    public function view()
    {
        $this->bladeResponse(array('Ioana' => 1), 'products/login');

    }

}