<?php
    require_once './Circle.php';
    require_once './Triangle.php';
    require_once './Rectangle.php';

    $circle = new Circle(3);
    echo 'Circle </br> Area = ' . $circle->calculateArea() . '</br>';
    echo 'Perimeter = ' . $circle->calculatePerimeter() . '</br>';

    $triangle = new Triangle(5, 3, 4);
    echo 'Triangle </br> Area = ' . $triangle->calculateArea() . '</br>';
    echo 'Perimeter = ' . $triangle->calculatePerimeter() . '</br>';

    $rectangle = new Rectangle(5, 5, 3, 3);
    echo 'Rectangle </br> Area = ' . $rectangle->calculateArea() . '</br>';
    echo 'Perimeter = ' . $rectangle->calculatePerimeter() . '</br>';