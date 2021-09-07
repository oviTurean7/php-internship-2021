<?php

require 'C:\xampp\htdocs\PHP Training\public\oop\errors.php';
require 'C:\xampp\htdocs\PHP Training\public\oop\Shape.php';

$rectangle = new Rectangle(10,20, [10, 20, 10, 20]);
echo 'Area is ', $rectangle->calculateArea(), '<br>';
echo 'Perimeter is ', $rectangle->calculateLength(), '<br>';
$rectangle->setColor('blue');
echo 'Color is ', $rectangle->getColor(), '<br>';
$triangle = new Triangle(0, 0, [24, 18, 30]);
echo 'Area is ', $triangle->calculateArea(), '<br>';
echo 'Perimeter is ', $triangle->calculateLength(), '<br>';
$triangle->setColor('red');
echo 'Color is ', $triangle->getColor(), '<br>';
$square = new Square(10, 10, [10, 10]);
echo 'Area is ', $square->calculateArea(), '<br>';
echo 'Perimeter is ', $square->calculateLength(), '<br>';
$square->setColor('yellow');
echo 'Color is ', $square->getColor(), '<br>';

echo $triangle->getUsage();

echo $asdf;
