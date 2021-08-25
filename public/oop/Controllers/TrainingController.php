<?php

namespace Oop\Controllers;

use Training;

$training = new Training();


class TrainingController
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

}