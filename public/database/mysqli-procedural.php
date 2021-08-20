<?php

$config = require_once '../../config.php';

$conn = mysqli_connect($config['database']['server'], $config['database']['user'], $config['database']['password'], $config['database']['name']);

if(!$conn) {
    die('Connection failed:' . mysqli_connect_error());
}
echo 'Connected succesfully';

$fname = 'Alex';
$lname = 'Zgimbau';

$sql = "INSERT INTO users(first_name, last_name, email, address, phone) VALUES ('Alex', 'Zgimbau', 'alexz@gmail.com', 'Andrei Muresanu nr 4', '0742097257');";
$sql .= "INSERT INTO users(first_name, last_name, email, address, phone) VALUES ('Dani', 'Zavatzki', 'daniz@gmail.com', 'Calea Turzii nr 36', '0742097942');";

mysqli_multi_query($conn, $sql);