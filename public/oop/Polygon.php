<?php

abstract class Polygon extends Shape
{

    protected $dimensions;

    public function __construct($array)
    {
        $this->dimensions = $array;
    }

    public abstract function calculateArea();

    public function calculateLength()
    {
        $res = 0;
        foreach ($this->dimensions as $dimension) {
            $res += $dimension;
        }
        return $res;
    }
}