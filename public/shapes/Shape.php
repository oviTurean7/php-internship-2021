<?php

class Shape
{
    private $length;
    private $width;
    private $color;

    /**
     * @param $length
     * @param $width
     */
    public function __construct($length, $width)
    {
        $this->length = $length;
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length): void
    {
        $this->length = $length;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    public function calculateArea() {
        return $this->width * $this->length;
    }

    public function calculateLength() {
        return 2 * $this->width + 2 * $this->length;
    }



}