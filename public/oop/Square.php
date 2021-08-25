<?php

class Square extends Polygon
{
    private $side;


    public function __construct($side)
    {
        $this->side = $side;
        $this->dimensions = [$side, $side, $side, $side];
    }

    public function calculateArea()
    {
        return $this->side * $this->side;
    }
}