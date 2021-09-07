<?php
require_once '../vendor/autoload.php';

$request = new App\Core\Request();

$app = new App\Core\Application();

$app->handle($request);

header('Access-Control-Allow-Origin: http://internship.local');
header('Content-Type: application/json');
