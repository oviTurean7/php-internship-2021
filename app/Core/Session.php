<?php

namespace App\Core;

class Session
{

    private function startSession() {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }

    public function get($name)
    {
        $this->startSession();
        if (isset($_SESSION[$name]))
            return $_SESSION[$name];

        return false;
    }

    public function put($name, $data)
    {
        $this->startSession();
        if (isset($_SESSION[$name]) && is_array($_SESSION[$name])) {
            $_SESSION[$name][] = $data;
        } else {
            $_SESSION[$name] = $data;
        }
    }

    public function forget($name)
    {
        $this->startSession();
        if (isset($_SESSION[$name]))
            unset($_SESSION[$name]);
    }

    public function isSet($name)
    {
        $this->startSession();
        return isset($_SESSION[$name]);
    }
}