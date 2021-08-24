<?php

//namespace
require_once './Shape.php';

class Circle extends Shape {

    private $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function calculateArea()
    {
        return pi()* $this->radius * $this->radius;
    }

    public function calculatePerimeter()
    {
        return 2* pi()* $this->radius;
    }
}