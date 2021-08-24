<?php

namespace App\Controllers;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

require_once '../vendor/autoload.php';

class SignupController extends BaseController
{
    static function tokenize($array) {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($array);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        return $jwt;
    }

    static function decode($token) {
        $payload64UrlPayload = explode(".", $token)[1];
        $payload64 = str_replace(['-', '_', ''], ['+', '/', '='], $payload64UrlPayload);
        $payload = base64_decode($payload64);
        return json_decode($payload);;

    }



    public function signup() {
        global $db;
        global $conn;
        $email = $_POST['email'];
        $pattern = '/(.+@.+\..+)/';
        $subject = 'a@m.c';
        $res = preg_match($pattern, $subject);
        if ($res === 0) {
            echo 'Incorrect email format';
            http_response_code(404);
            return;
        }
        $sql = "SELECT email, password FROM users WHERE email =  '$email'";
        //echo $sql . "\n";

        $result = $conn->query($sql);
        if ($result->num_rows !== 0) {
            echo 'Email already in the database';
            http_response_code(404);
            return;
        }





        $stmt = $conn->prepare("INSERT  INTO users(first_name, last_name,
        email, address, phone, password, confirmed, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("ssssssbs", $firstname, $lastname, $email, $address, $phone, $password, $confirmed, $token);
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $password = md5($_POST['password']);
        $confirmed = false;
        $token = self::tokenize(['email' => $email]);
       // var_dump ($_POST['email']);

        $stmt->execute();

        $stmt->close();
        EmailController::mail($email, $token);
        //echo "Success";
    }


    public function view()
    {
        $this->bladeResponse(array('Ioana' => 1), 'products/signup');

    }
}