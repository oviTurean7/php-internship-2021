<?php

namespace Oop\Core;

$config = include_once "../config.php";


class Config
{
    public function get ($name = null) {
        global $config;
        if ($name === null) {
            return $config;
        }
        if(isset($config[$name])) {
            return $config[$name];
        }
    }


}