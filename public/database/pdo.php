<?php

function tokenize($array) {
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode($array);
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    return $jwt;
}



$db = (include basePath() . "\config.php")['database'];
$server = $db['server'];
$username = $db['username'];
$password = $db['password'];
$name = $db['name'];
try {
    $conn = new PDO("mysql:host=$server;dbname=$name",
        $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}



$stmt = $conn->prepare("INSERT  INTO users(first_name, last_name,
email, address, phone, password, confirmed, token)  VALUES (:firstname, :lastname, :email, :address, :phone, :password, :confirmed, :token)");


$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':confirmed', $confirmed);
$stmt->bindParam(':token', $token);

$firstname = 'Ioana';
$lastname = 'Pana';
$email = 'ioana@gmail.com';
$address = 'alabala';
$phone = '0567898327';
$password = md5('ioana');
$confirmed = 1;
$token = tokenize([]);


$stmt->execute();

$firstname = 'Ilinca';
$lastname = 'Pana';
$email = 'ilinca@gmail.com';
$address = 'alabala';
$phone = '0567898327';
$password = md5('ilinca');
$confirmed = 1;
$token = tokenize([]);


$stmt->execute();


