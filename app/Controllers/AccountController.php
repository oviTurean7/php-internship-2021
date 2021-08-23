<?php

namespace App\Controllers;
const PASSWORD = 'mail_password';



global $configDB;
$configDB = require_once basePath() . '/configDB.php';
require_once basePath() . '/vendor/autoload.php';

class AccountController extends BaseController
{
    public function showLoginForm() {
        $this->bladeResponse([], '/account/login');
    }

    private function setConnection() {
        global $configDB;

        $conn = new \mysqli($configDB['database']['server'], $configDB['database']['user'], $configDB['database']['password'], $configDB['database']['name']);
        if (!$conn) {
            die('Connection failed:' . $conn->connect_error);
        }
        return $conn;
    }

    private function login($email, $hashPass, $token, $confirmed = 0) {
        global $config;
        if($confirmed == 1) {
            session_start();
            $_SESSION['user'] = array("email" => $email, "password" => $hashPass, "token" => $token);
            header('Location: ' . $config['url'] . '/home');
        }
    }

    public function checkLoginData() {
        if (isset($_REQUEST['email'])) {
            $conn = $this->setConnection();
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            $query = "SELECT `email`, `password`, `confirmed`, `token` from `users` WHERE strcmp(`email`,'$email') = 0";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashPass = md5($row['password']);

                if (strcmp(md5($password), $hashPass) === 0) {
                    $this->login($row['email'], $hashPass, $row['token']);
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
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('robert3paul')
            ->setPassword(PASSWORD);

        $mailer = new \Swift_Mailer($transport);
// Create a message
        $message = (new \Swift_Message('First email'))
            ->setFrom(['robert3paul@gmail.com' => 'Robert Gherghel'])
            ->setTo(['robert.gherghel@bitstone.eu'])
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
        $conn = $this->setConnection();
        $query = "SELECT `email`, `password` from `users` WHERE strcmp(`email`,'$email') = 0";
        $result = $conn->query($query);

        if ($result->num_rows === 0) {
            $conn = $this->setConnection();
            $query = "INSERT INTO `users`(email, password, first_name, last_name, address) VALUES('$email', '$password', '$fname', '$lname', '$address')";
            $result = $conn->query($query);
            if ($result) {
                $conn = $this->setConnection();
                $query = "SELECT `id` from `users` WHERE strcmp(`email`,'$email') = 0";
                $queryResult = $conn->query($query);
                $row = $queryResult->fetch_assoc();

                $userID = $row['id'];
                $token = md5(uniqid($row['id'], true));
                $conn = $this->setConnection();
                $setToken = "UPDATE `users` set `token`='$token' WHERE `id` = $userID";
                $conn->query($setToken);

                $this->sendEmail($email, $token);
            }
        }
    }

    public function checkRegisterData() {
        if (isset($_REQUEST['email']) && strlen($_REQUEST['email']) > 5 && isset($_REQUEST['password']) && strlen($_REQUEST['password']) > 3 && isset($_REQUEST['fname']) && strlen($_REQUEST['fname']) > 2 && isset($_REQUEST['lname']) && strlen($_REQUEST['lname']) > 2 && isset($_REQUEST['address']) && strlen($_REQUEST['address']) > 5) {
            $this->register($_REQUEST['email'], $_REQUEST['password'], $_REQUEST['fname'], $_REQUEST['lname'], $_REQUEST['address']);
        }
    }

    public function confirmMail() {
        if (isset($_REQUEST['token'])) {
            $token = $_REQUEST['token'];
            $conn = $this->setConnection();
            $query = "SELECT * from `users` WHERE strcmp(`token`,'$token') = 0";
            $queryResult = $conn->query($query);
            if ($queryResult->num_rows > 0) {
                $result = $queryResult->fetch_assoc();
                $userID = $result['id'];
                $conn = $this->setConnection();
                $setConfirmed = "UPDATE `users` set `confirmed`=1 WHERE `id` = $userID";
                $conn->query($setConfirmed);

                $this->login($result['email'], $result['password'], $result['token'], 1);
            }
        }
    }
}
