<?php

use Oop\Core\Application;
use Oop\Core\Request;

require_once '../../vendor/autoload.php';
//include_once 'routes.php';
include "./Training.php";

$training = new Training();

$training->name = "Ioana";
echo $training->name;
echo "<br>";
echo isset($training->name);
echo "<br>";
 unset($training->name);
echo "<br>";
$training->test();
echo "<br>";
Training::testStatic();
echo "<br>";
echo $training;
echo "<br>";
var_export($training);
echo "<br>";
var_dump($training);
echo "<br>";
$training("Ioana");
echo "<br>";
echo __LINE__;
echo "<br>";
echo __FILE__;
echo "<br>";
echo __DIR__;
echo "<br>";
$training->use();
echo "<br>";
$training->className();
echo "<br>";
$training->method();
echo "<br>";
$training->namespace();
echo "<br>";
echo Training::class;
echo "<br>";

