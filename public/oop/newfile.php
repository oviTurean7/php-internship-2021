<?php
include "./Training.php";

$training = new Training();

$serialized = serialize($training);
echo $serialized;
echo "<br>";
echo unserialize($serialized);

$training2 = clone $training;
echo "<br>";
var_dump($training);
echo "<br>";
var_dump($training2);
echo "<br>";
$training->intParam(1);
echo "<br>";
$training->arrParam([]);
echo "<br>";
//$training->arrParam($training2);
//fatal error
echo "<br>";