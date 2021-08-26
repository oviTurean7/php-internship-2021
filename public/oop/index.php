<?php



require_once '../../vendor/autoload.php';
//include_once 'routes.php';

use Oop\Core\Application;
use Oop\Core\Request;

function myError($errorNumber, $errorText) {
    echo "<b>Error</b> $errorNumber: $errorText";
}

set_error_handler("myError");

error_reporting(-1);
ini_set("error_log", "errors.php");
//trigger_error("I am triggered");
//throw new Exception("excuuuuseee me"); /* nope */


$request = new Request();

$app = new Application();

$app->handle($request);
