<?php

namespace App\Controllers;

use OAuthProvider;
use PDO;

class TestController extends BaseController
{
    public function test()
    {
        include 'C:\xampp\htdocs\PHP Training\data\products.php';

        if (isset($data)) {
            $this->bladeResponse($data, 'products/list');
        }

    }

    public function cart()
    {
        include 'C:\xampp\htdocs\PHP Training\data\products.php';

        if (isset($data)) {
            $this->bladeResponse($data, 'products/cart');
        }
    }

    public function deleteCartItem()
    {

        if (empty($_POST['delId'])) {
            //do some error handling
            exit('error');
        }

        session_start();

        $product_id = $_POST['delId'];
        $idToDel = array_search($product_id, $_SESSION['cart']);

        if (!empty($_SESSION['cart']) && !empty($_SESSION['cart'][$idToDel])) {
            unset($_SESSION['cart'][$idToDel]);
            unset($_SESSION['quantities'][$product_id]);
        }
        echo 'success';
        die();

    }

    public function loginform()
    {
        include_once 'C:\xampp\htdocs\PHP Training\public\database\pdo.php';

        if (isset($users))
            $this->bladeResponse($users, 'login/login-form');
    }

    public function registerform()
    {
        include_once 'C:\xampp\htdocs\PHP Training\public\database\pdo.php';

        if (isset($users))
            $this->bladeResponse($users, 'login/register-form');
    }

    /**
     * @throws \Exception
     */
    public function register()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            echo 'ლ(ಠ益ಠლ)';
        else {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $conn = new PDO("mysql:host=localhost;dbname=ecommerce", 'root', '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $conn->prepare("SELECT * FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                echo '<p class="error">The email address is already registered!</p>';
            }
            if ($query->rowCount() == 0) {
                $query = $conn->prepare("INSERT INTO users(first_name, last_name, password, email, token) VALUES (:first_name,:last_name,:password_hash,:email,:token)");
                $query->bindParam("first_name", $firstname, PDO::PARAM_STR);
                $query->bindParam("last_name", $lastname, PDO::PARAM_STR);
                $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
                $query->bindParam("email", $email, PDO::PARAM_STR);
                $token = bin2hex(random_bytes(8));;
                $query->bindParam("token", $token, PDO::PARAM_STR);
                $result = $query->execute();
                if ($result) {
                    $to = $email;
                    $subject = 'confirm mail';
                    $message = 'Confirm account';
                    $headers = 'From: internship.local@yopmail.com' . "\r\n" .
                        'Reply-To: sender@yopmail.com ' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    mail($to, $subject, $message, $headers);
                    echo '<p class="success">Your registration was successful!</p>';
                } else {
                    echo '<p class="error">Something went wrong!</p>';
                }
            }
        }
    }

    public function login()
    {
        session_start();
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $conn = new PDO("mysql:host=localhost;dbname=ecommerce", 'root', '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $conn->prepare("SELECT * FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                echo '<p class="error">Email password combination is wrong!</p>';
            } else {
                if (password_verify($password, $result['password'])) {
                    $_SESSION['user_id'] = $result['id'];
                    echo '<p class="success">Congratulations, you are logged in!</p>';
                } else {
                    echo '<p class="error">Email password combination is wrong!</p>';
                }
            }
        } else echo 'ლ(ಠ益ಠლ)';
    }

    public function upload()
    {
        if (isset($_POST["submit"])) {
            $allowed = array("jpg" => true, "png" => true, "gif" => true, "txt" => true);
            $filename = $_FILES['file']['name'];
            $source = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $save = "./images/" . $filename;
            $maxsize = 1024 * 1024 * 10;
            $ext = explode(".", $filename);
            if (preg_match('/^[A-Za-z0-9\-\_]{1,}\.[a-zA-Z0-9]{0,4}$/', $filename)) {
                if (!empty($allowed[strtolower($nameext[1])]) && $allowed[strtolower($ext[1])] === true) {
                    if ($size <= $maxsize) {
                        if (!file_exists($save)) {
                            if (move_uploaded_file($source, $save)) {
                                chmod($save, 644);
                                echo "Successful upload.";
                            } else echo "Cannot move";
                        } else echo "Existing file";
                    } else echo "Too big file";
                } else echo "Not allowed extension";
            } else echo "Only alphanumeric files allowed";
        } else echo 'ლ(ಠ益ಠლ)';
    }

    public function confirm()
    {

    }

    public function shape()
    {
        session_start();
    }

    public function categories()
    {

    }
}
