<?php

$config = require_once '../../config.php';

$conn = new mysqli($config['database']['server'], $config['database']['user'], $config['database']['password'], $config['database']['name']);

if($conn->connect_error) {
    die('Connection failed:' . $conn->connect_error);
}
echo 'Connected succesfully';

$sql = "INSERT INTO users(first_name, last_name, email, address, phone) VALUES ('Alex', 'Zgimbau', 'alexz@gmail.com', 'Andrei Muresanu nr 4', '0742097257');";
$sql .= "INSERT INTO users(first_name, last_name, email, address, phone) VALUES ('Dani', 'Zavatzki', 'daniz@gmail.com', 'Calea Turzii nr 36', '0742097942');";

$conn->multi_query($sql);