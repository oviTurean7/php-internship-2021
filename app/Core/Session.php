<?php

namespace App\Core;

class Session
{
    public function get($name)
    {
        session_start();
        if (isset($_SESSION[$name]))
            return $_SESSION[$name];

        return false;
    }

    public function put($name, $data)
    {
        session_start();
        if (isset($_SESSION[$name]) && is_array($_SESSION[$name])) {
            $_SESSION[$name][] = $data;
        } else {
            $_SESSION[$name] = $data;
        }
    }

    public function forget($name)
    {
        session_start();
        if (isset($_SESSION[$name]))
            unset($_SESSION[$name]);
    }

    public function isSet($name)
    {
        session_start();
        return isset($_SESSION[$name]);
    }
}