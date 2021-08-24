<?php

//namespace App\public\oop;

abstract class Shape {
    public $color;

    abstract function calculateArea();

    abstract public function calculatePerimeter();

    public function setColor($color) {
        $this->color = $color;
    }
}