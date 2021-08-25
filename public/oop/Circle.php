<?php

class Circle extends Shape
{
    private $radius;



    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function calculateArea()
    {
        $pi = 3.14;
        return $pi * $this->radius * $this->radius;
    }

    public function calculateLength()
    {
        $pi = 3.14;
        return $pi * $this->radius * 2;
    }
}