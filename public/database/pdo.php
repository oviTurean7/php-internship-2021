<?php
require_once 'C:\xampp\htdocs\PHP Training\config.php';
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'ecommerce';

try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO users(first_name, last_name, email) VALUES (:firstname, :lastname, :email)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);

    $users =
        [
            'user1' => ['Catalin', 'Sbera', 'catalin.sbera@bitstone.eu'],
            'user2' => ['Ion', 'Pop', 'ion.pop@bitstone.eu']
        ];

//    foreach ($users as $user => $data) {
//        $firstname = $data[0];
//        $lastname = $data[1];
//        $email = $data[2];
//        $stmt->execute();
//    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

