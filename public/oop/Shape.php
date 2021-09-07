<?php

abstract class Shape
{
    public string $color;
    public int $L;
    public int $W;
    const DOMAIN = 'mathematics';
    static string $subdomain = 'geometry';

    static public function getUsage(): string
    {
        return  static::DOMAIN .' - '.self::$subdomain;
    }

    public function __construct($L, $W)
    {
        $this->L = $L;
        $this->W = $W;
    }

    abstract public function calculateArea();

    abstract public function calculateLength();

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }

}

class Circle extends Shape
{
    public float $pi = 3.14;

    public function __construct($L, $W, $pi)
    {
        parent::__construct($L, $W);
        $this->pi = $pi;
    }

    public function calculateArea()
    {
        return $this->L * $this->pi;
    }

    public function calculateLength()
    {
        return $this->pi * $this->L * 2;
    }
}

abstract class Polygon extends Shape
{
    public array $dimensions = [];

    public function __construct($L, $W, $dimensions)
    {
        parent::__construct($L, $W);
        $this->dimensions = $dimensions;
    }

    abstract public function calculateArea();

    public function calculateLength()
    {
        $perimeter = 0;
        foreach ($this->dimensions as $side)
            $perimeter += $side;
        return $perimeter;
    }
}

class Triangle extends Polygon
{
    public function __construct($L, $W, $dimensions)
    {
        parent::__construct($L, $W, $dimensions);
        static::$subdomain = '3 side polygon';
    }

    public function calculateArea(): float
    {
        $p = ($this->dimensions[0] + $this->dimensions[1] + $this->dimensions[2]) / 2;
        return sqrt($p * ($p - $this->dimensions[0]) * ($p - $this->dimensions[1]) * ($p - $this->dimensions[2]));
    }
}

class Rectangle extends Polygon
{
    public function __construct($L, $W, $dimensions)
    {
        parent::__construct($L, $W, $dimensions);
    }

    public function calculateArea()
    {
        return $this->dimensions[0] * $this->dimensions[1];
    }
}

class Square extends Rectangle
{
    public function __construct($L, $W, $dimensions)
    {
        parent::__construct($L, $W, $dimensions);
    }

    public function calculateArea(): int
    {
        return pow($this->L, 2);
    }
}