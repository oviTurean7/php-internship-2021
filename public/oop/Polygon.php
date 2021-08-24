<?php

abstract class Polygon extends Shape {

    protected $lengths = [];

    public function __construct($lengths) {
        $this->lengths = $lengths;
    }

    abstract public function calculateArea();

    public function calculatePerimeter()
    {
        return array_sum($this->lengths);
    }
}