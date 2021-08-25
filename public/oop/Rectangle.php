<?php

class Rectangle extends Polygon
{
    private $height;
    private $width;

    /**
     * @param $height
     * @param $width
     */
    public function __construct($height, $width)
    {
        $this->height = $height;
        $this->width = $width;
        $this->dimensions = [$height, $width, $height, $width];
    }

    public function calculateArea()
    {
        return $this->height * $this->width;
    }
}