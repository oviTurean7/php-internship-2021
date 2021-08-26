<?php

require_once './Training.php';

$training = new Training();
$serialized = serialize($training);

echo '</br>Serialized</br>';
var_dump($serialized);
echo '</br>Deserialized</br>';
var_dump(unserialize($serialized));
echo '</br></br>';

echo 'Copy:</br>';
$training_copy = clone $training;
var_dump($training_copy);
echo '</br></br>';

echo 'Modified:</br>';
$training->declared = 2;
var_dump($training);
echo '</br>Initial copy:</br>';
var_dump($training_copy);
echo '</br></br>';
