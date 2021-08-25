<?php

require_once oopPath() . "/Shape.php";

//$shape = new Shape();
/*
 * Impossible abstract classes cannot be instantiated
 */
//echo $shape->calculateArea();
//echo $shape->calculateLength();
//$shape->setColor("red");
//echo $shape->getColor();

$circle = new Circle(2);

echo $circle->calculateArea();
echo $circle->calculateLength();
$circle->setColor("red");
echo $circle->getColor();

$triangle = new Triangle(1, 2, 3);

echo $triangle->calculateArea();
echo $triangle->calculateLength();
$triangle->setColor("blue");
echo $triangle->getColor();

$rectangle = new Rectangle(1, 2);

echo $rectangle->calculateArea();
echo $rectangle->calculateLength();
$rectangle->setColor("green");
echo $rectangle->getColor();

$square = new Square(2);

echo $square->calculateArea();
echo $square->calculateLength();
$square->setColor("green");
echo $square->getColor();

Shape::getUsage();
Triangle::getUsage();