<?php

require_once './Polygon.php';

class Rectangle extends Polygon {

    public function __construct($length1, $length2, $width1, $width2)
    {
        parent::__construct([$length1, $length2, $width1, $width2]);
    }

    public function calculateArea()
    {
        return $this->lengths[0] * $this->lengths[2];
    }
}