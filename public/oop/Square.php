<?php

require_once './Rectangle.php';

class Square extends Rectangle {

    public function __construct($length1, $length2, $width1, $width2)
    {
        parent::__construct($length1, $length2, $width1, $width2);
    }

    public function calculateArea()
    {
        return pow($this->lengths[0], 2);
    }
}