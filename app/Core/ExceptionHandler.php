<?php

namespace App\Core;

class ExceptionHandler
{
    public function handle($e)
    {
        $this->report($e);
        $this->render($e);
    }

    protected function report($e)
    {
        //TODO - log this exception
        echo " $e<br>";
    }

    protected function render($e)
    {
        //TODO - return a custom blade for errors
        echo "$e<br>";
    }
}
