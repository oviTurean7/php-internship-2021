<?php

class CustomException extends Exception
{
    public function errorMessage(): string
    {
        error_log($this->getMessage());
        return 'Error on line '.$this->getLine().' in '.$this->getFile()
            .': <b>'.$this->getMessage().'</b> is not a valid E-Mail address';
    }

}