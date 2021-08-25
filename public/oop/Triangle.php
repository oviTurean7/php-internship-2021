<?php

class Triangle extends Polygon
{

    private $side1;
    private $side2;
    private $side3;
    public static $subdomain = '3 side polygon';

    public function __construct($side1, $side2, $side3)
    {
        $array = [$side1, $side2, $side3];
        $this->dimensions = $array;
    }

    public function calculateArea()
    {

        $perimeter = $this->calculateLength();
        return sqrt($perimeter * ($perimeter - $this->side1) * ($perimeter - $this->side2) * ($perimeter - $this->side3));
    }
}