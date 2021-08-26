<?php

namespace Oop\Controllers;
//include "../Training.php";


use Oop\Training;
global $training;
$training = new Training();


class TrainingController extends BaseController
{
    public function use() {
        global $training;
        $training->use();
    }

    public function className() {
        global $training;
        $training->className();
    }

    public function method() {
        global $training;
        $training->method();
    }

    public function namespace() {
        global $training;
        $training->namespace();
    }

    public function view () {

        global $training;

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
    }

}