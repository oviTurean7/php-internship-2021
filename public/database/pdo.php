<?php

$config = require_once '../../config.php';

try{
    $conn = new PDO("mysql:host=".$config['database']['server'].";dbname=".$config['database']['user'], $config['database']['password'], $config['database']['name']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$sql = "INSERT INTO users(first_name, last_name, email, address, phone) VALUES ('Alex', 'Zgimbau', 'alexz@gmail.com', 'Andrei Muresanu nr 4', '0742097257');";
$sql .= "INSERT INTO users(first_name, last_name, email, address, phone) VALUES ('Dani', 'Zavatzki', 'daniz@gmail.com', 'Calea Turzii nr 36', '0742097942');";

$conn->multi_query($sql);