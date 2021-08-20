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


$conn =  new mysqli($db['server'], $db['username'], $db['password'], $db['name']
);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$stmt = $conn->prepare("INSERT  INTO users(first_name, last_name,
email, address, phone, password, confirmed, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssbs", $firstname, $lastname, $email, $address, $phone, $password, $confirmed, $token);
$firstname = 'Ioana';
$lastname = 'Pop';
$email = 'ioana@gmail.com';
$address = 'alabala';
$phone = '0567898327';
$password = md5('ioana');
$confirmed = true;
$token = tokenize([]);


$stmt->execute();

$firstname = 'Ilinca';
$lastname = 'Pop';
$email = 'ilinca@gmail.com';
$address = 'alabala';
$phone = '0567898327';
$password = md5('ilinca');
$confirmed = true;
$token = tokenize([]);


$stmt->execute();

$stmt->close();

