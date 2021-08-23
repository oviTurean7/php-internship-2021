<?php

namespace App\Controllers;

global $configDB;
$configDB = require_once basePath() . '/configDB.php';

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

    public function checkLoginData() {
        global $config;

        if (isset($_REQUEST['email'])) {
            $conn = $this->setConnection();
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];

            $query = "SELECT `email`, `password` from `users` WHERE strcmp(`email`,'$email') = 0";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashPass = md5($row['password']);

                if (strcmp(md5($password), $hashPass) === 0) {
                    session_start();
                    $_SESSION['user'] = array("email" => $row['email'], "password" => $hashPass);
                    header('Location: '.$config['url'].'/home');
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
            }
        }
    }

    public function checkRegisterData() {
        if (isset($_REQUEST['email']) && strlen($_REQUEST['email']) > 5 && isset($_REQUEST['password']) && strlen($_REQUEST['password']) > 3 && isset($_REQUEST['fname']) && strlen($_REQUEST['fname']) > 2 && isset($_REQUEST['lname']) && strlen($_REQUEST['lname']) > 2 && isset($_REQUEST['address']) && strlen($_REQUEST['address']) > 5) {
            $this->register($_REQUEST['email'], $_REQUEST['password'], $_REQUEST['fname'], $_REQUEST['lname'], $_REQUEST['address']);
        }
    }


}
