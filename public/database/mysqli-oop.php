<?php

$config = require_once '../../config.php';

function newConnection($config) {
    $conn = new mysqli($config['database']['server'], $config['database']['user'], $config['database']['password'], $config['database']['name']);
    return $conn;
}

$conn = newConnection($config);

$sql = "INSERT INTO users (first_name, last_name, email, address, phone) VALUES ('Alex', 'Zgimbau', 'alexz@gmail.com', 'Andrei Muresanu nr 4', '0742097257');";
$sql .= "INSERT INTO users (first_name, last_name, email, address, phone) VALUES ('Dani', 'Zavatzki', 'daniz@gmail.com', 'Calea Turzii nr 36', '0742097942');";

$conn->multi_query($sql);

$conn = newConnection($config);

$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row['id'] . " " . $row['first_name'] . " " . $row['last_name'] . "<br>";
    }
} else {
    echo '0 results';
}

