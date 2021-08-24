<?php

require_once './Polygon.php';


class Triangle extends Polygon {

    public function __construct($l1, $l2, $l3)
    {
        parent::__construct([$l1, $l2, $l3]);
    }

    public function calculateArea()
    {
        $semiperimeter = $this->calculatePerimeter() / 2;
        $area = $semiperimeter;

        foreach ($this->lengths as $length) {
            $area *= ($semiperimeter - $length);
        }
        return sqrt($area);
    }
}