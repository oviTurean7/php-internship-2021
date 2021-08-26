<?php

//function customError($errno, $errstr)
//{
//    echo "<b>Error:</b> [$errno] $errstr";
//}
//set_error_handler("customError");
//
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//
//trigger_error("customError");
//
////throw new Exception("customError");

class CustomException extends Exception
{
    public function errorMessage()
    {
        $errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b> is not a valid E-Mail address';
        return $errorMsg;
    }
}

function customException($e)
{
    error_log("Custom handler reached");
    echo "Custom handler reached";
}
set_exception_handler('customException');

$email = "someone@example...com";
//try {
//check if
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        throw new customException($email);
    }
//} catch (Exception $e) {
//    echo $e;
//}catch (CustomException $e) {
//    echo $e->errorMessage();
//}
