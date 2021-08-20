<?php

$config = require_once(__DIR__.'/../../configDB.php');

function newConnection($config) {
    $conn = new mysqli($config['database']['server'], $config['database']['user'], $config['database']['password'], $config['database']['name']);
    if (!$conn) {
        die('Connection failed:' . mysqli_connect_error());
    }
    return $conn;
}

//$conn = newConnection($config);
//$sql = "INSERT INTO `users` (first_name, last_name, email, address, phone, password) VALUES ('Alex', 'Zgimbau', 'alexz@gmail.com', 'Andrei Muresanu nr 4', '0742097257', '');";
//mysqli_query($conn, $sql);

$conn = newConnection($config);

$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql) or die("<br>Select error");

$rows = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
} else {
    echo '0 results';
}

return $rows;

