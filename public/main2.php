<?php

use App\Training\Training;

require 'C:\xampp\htdocs\PHP Training\public\oop\Training.php';

$var = new Training('var', 'black', 12);

$var->magic_const();

$ser = serialize($var);
var_dump($ser);
echo '<br>';
file_put_contents('C:\xampp\htdocs\PHP Training\public\oop\contents\var.txt', $ser);

$ser = file_get_contents('C:\xampp\htdocs\PHP Training\public\oop\contents\var.txt');
$a = unserialize($ser);

var_dump($a);
echo '<br>';

$var_cpy = clone $var;
var_dump($var);
echo '<br>';
var_dump($var_cpy);
echo '<br>';

$var2 = new Training('var2', 'yellow', 98);
echo isset($var2);