<?php
require 'C:\xampp\htdocs\PHP Training\config.php';

$server = 'localhost';
$username = 'root';
$password = '';
$db = 'ecommerce';

$conn = new mysqli($server, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


