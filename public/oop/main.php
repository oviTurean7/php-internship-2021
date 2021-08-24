<?php
    require_once './Circle.php';
    require_once './Triangle.php';
    require_once './Rectangle.php';
    require_once './Square.php';

    $circle = new Circle(3);
    echo 'Circle </br> Area = ' . $circle->calculateArea() . '</br>';
    echo 'Perimeter = ' . $circle->calculatePerimeter() . '</br>';

    $triangle = new Triangle(5, 3, 4);
    $triangle->setColor('red');
    echo 'Triangle </br> Area = ' . $triangle->calculateArea() . '</br>';
    echo 'Perimeter = ' . $triangle->calculatePerimeter() . '</br>';
    echo "Color = $triangle->color</br>";

    $rectangle = new Rectangle(5, 5, 3, 3);
    echo 'Rectangle </br> Area = ' . $rectangle->calculateArea() . '</br>';
    echo 'Perimeter = ' . $rectangle->calculatePerimeter() . '</br>';

    $square = new Square(3, 3, 3, 3);
    echo 'Square </br> Area = ' . $square->calculateArea() . '</br>';
    echo 'Perimeter = ' . $square->calculatePerimeter() . '</br>';

    Triangle::getUsage();
