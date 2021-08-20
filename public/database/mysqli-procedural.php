<?php

$config = require_once '../../config.php';

$conn = mysqli_connect($config['database']['server'], $config['database']['user'], $config['database']['password'], $config['database']['name']);

if (!$conn) {
    die('Connection failed:' . mysqli_connect_error());
}
echo 'Connected succesfully';

$sql = "INSERT INTO `users` (first_name, last_name, email, address, phone, password) VALUES ('Alex', 'Zgimbau', 'alexz@gmail.com', 'Andrei Muresanu nr 4', '0742097257', '');";
$sql = "SELECT * FROM `users`";

$result = mysqli_query($conn, $sql) or die("<br>Select error");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['id'] . " " . $row['first_name'] . " " . $row['last_name'] . "<br>";
    }
} else {
    echo '0 results';
}

