<?php

namespace App\Controllers;

use App\DAL\DBConnection;

require_once basePath() . '/vendor/autoload.php';

class AccountController extends BaseController
{
    public function showLoginForm() {
        $this->bladeResponse([], '/account/login');
    }

    private function login($email, $hashPass, $token, $confirmed = 0) {
        global $config;

        if($confirmed == 1) {
            session_start();
            $_SESSION['user'] = array("email" => $email, "password" => $hashPass, "token" => $token);
            header('Location: ' . $config['url'] . '/products');
        }
    }

    public function checkLoginData() {
        if (isset($_REQUEST['email'])) {
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            $query = "SELECT `email`, `password`, `confirmed`, `token` from `users` WHERE strcmp(`email`,'$email') = 0";
            $dbConnection = new DBConnection();
            $result = $dbConnection->getSingleData($query);

            if ($result) {
                $hashPass = md5($result['password']);

                if (strcmp(md5($password), $hashPass) === 0) {
                    $this->login($result['email'], $hashPass, $result['token'], $result['confirmed']);
                }
            }
            else {
                die(json_encode(array('message' => 'Error', 'code' => 404)));
            }
        }
        else {
            die(json_encode(array('message' => 'Error', 'code' => 404)));
        }
    }

    public function showHome() {
        if (isset($_SESSION['user'])) {

        }
        $this->bladeResponse([], '/account/home');
    }

    public function showRegister() {
        $this->bladeResponse([], '/account/register');
    }

    private function sendEmail($email, $token) {
        global $config;

        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('robert3paul')
            ->setPassword($config['mailPassword']);

        $mailer = new \Swift_Mailer($transport);
// Create a message
        $message = (new \Swift_Message('First email'))
            ->setFrom(['robert3paul@gmail.com' => 'Robert Gherghel'])
            ->setTo([$email])
            ->setBody("Confirmation link: http://internship.local/confirm?token=$token");
// Send the message
        try {
            $result = $mailer->send($message);
        }
        catch (\Exception $exception) {
            var_dump($exception->getMessage());
        }
    }

    private function register($email, $password, $fname, $lname, $address) {
        $query = "SELECT `email`, `password` from `users` WHERE strcmp(`email`,'$email') = 0";
        $dbConnection = new DBConnection();
        $result = $dbConnection->getSingleData($query);

        if (!$result) {
            $dbConnection = new DBConnection();
            $query = "INSERT INTO `users`(email, password, first_name, last_name, address) VALUES('$email', '$password', '$fname', '$lname', '$address')";
            $insertResult = $dbConnection->insertData($query);

            if ($insertResult) {
                $dbConnection = new DBConnection();
                $query = "SELECT `id` from `users` WHERE strcmp(`email`,'$email') = 0";
                $user = $dbConnection->getSingleData($query);

                $userID = $user['id'];
                $token = md5(uniqid($user['id'], true));

                $dbConnection = new DBConnection();
                $setToken = "UPDATE `users` set `token`='$token' WHERE `id` = $userID";
                $dbConnection->updateData($setToken);

                $this->sendEmail($email, $token);
            }
        }
    }

    public function checkRegisterData() {
        if (isset($_REQUEST['email']) && strlen($_REQUEST['email']) > 5 && isset($_REQUEST['password']) && strlen($_REQUEST['password']) > 3 && isset($_REQUEST['fname']) && strlen($_REQUEST['fname']) >= 2 && isset($_REQUEST['lname']) && strlen($_REQUEST['lname']) >= 2 && isset($_REQUEST['address']) && strlen($_REQUEST['address']) >= 3) {
            $this->register($_REQUEST['email'], $_REQUEST['password'], $_REQUEST['fname'], $_REQUEST['lname'], $_REQUEST['address']);
        }
    }

    public function confirmMail() {
        if (isset($_REQUEST['token'])) {
            $token = $_REQUEST['token'];
            $dbConnection = new DBConnection();
            $query = "SELECT * from `users` WHERE strcmp(`token`,'$token') = 0";
            $result = $dbConnection->getSingleData($query);

            if ($result) {
                $userID = $result['id'];

                $dbConnection = new DBConnection();
                $setConfirmed = "UPDATE `users` set `confirmed`=1 WHERE `id` = $userID";
                $dbConnection->updateData($setConfirmed);

                $this->login($result['email'], $result['password'], $result['token'], 1);
            }
        }
    }
}
