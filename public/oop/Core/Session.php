<?php

class Session
{
    public $session;

    public function get($name)
    {
        if (isset($session[$name])) {
            return $session[$name];
        }
    }

    public function put($name, $value)
    {
        global $session;
        $session[$name] = $value;
    }

    public function forget($name)
    {
        if (isset($session[$name])) {
            unset($session[$name]);
        }
    }
}