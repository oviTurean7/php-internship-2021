<?php

require 'C:\xampp\htdocs\PHP Training\public\oop\CustomException.php';

function customError($errno, $erst)
{
    echo "<b>Error:</b> [$errno] $erst";
}

set_error_handler("customError");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$email = "someone@example...com";

function exception_handler($exception) {
    echo "custom handler reached " , $exception->getMessage(), "\n";
}

set_exception_handler('exception_handler');

throw new Exception('Uncaught Exception');

