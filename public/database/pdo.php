<?php

$config = require_once '../../config.php';

try{
    $conn = new PDO("mysql:host=".$config['database']['server'].";dbname=".$config['database']['name'], $config['database']['user'], $config['database']['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO users(first_name, last_name, email, address, phone) VALUES ('Alex', 'Zgimbau', 'alexz@gmail.com', 'Andrei Muresanu nr 4', '0742097257');";
    $sql .= "INSERT INTO users(first_name, last_name, email, address, phone) VALUES ('Dani', 'Zavatzki', 'daniz@gmail.com', 'Calea Turzii nr 36', '0742097942');";

    $conn->exec($sql);

    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
    foreach ($rows as $row) {
        //echo $row['id'] . " " . $row['first_name'] . " " . $row['last_name'] . "<br>";
    }

}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}



