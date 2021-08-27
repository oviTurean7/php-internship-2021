<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class MyExceptionHandler extends Exception
{
    private $headers;

    public function handle()
    {
//        $errorMsg = '<h3>Error:</h3></br>Error on line' . $this->getLine() . ' in ' . $this->getFile() . ': <b>' . $this->getMessage() . '</b>';
//        return $errorMsg;
        if (isset($this->headers['CONTENT_TYPE']) && strpos($this->headers['CONTENT_TYPE'], 'application/json') !== false) {
            var_dump(file_get_contents('php://input'));
        }
    }

    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }
}
