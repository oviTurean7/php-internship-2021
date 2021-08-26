<?php

namespace App\Core;

require_once basePath() . '/vendor/autoload.php';

class Config
{
    public function get($name)
    {
        global $config;

        if (empty($name)) return $config;
        if (strcmp($name, "database") === 0) $config = require basePath() . '/config-db.php';


        if (str_contains($name, '.')) {
            $accessNames = explode('.', $name);
            $data = $accessNames[0];
            for ($i = 1; $i < count($accessNames); $i++) {
                $data = $data[$accessNames[$i]];
            }
            return $data;
        } else {
            return $config[$name];
        }
    }
}