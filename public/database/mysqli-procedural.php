<?php
require 'C:\xampp\htdocs\PHP Training\config.php';

$server = 'localhost';
$username = 'root';
$password = '';
$db = 'ecommerce';

$conn = mysqli_connect($server, $username, $password, $db);

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";