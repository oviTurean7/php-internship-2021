<?php

//namespace App\public\oop;

abstract class Shape {

    const DOMAIN = "mathematics";
    static $SUBDOMAIN = "geometry";
    public $color;

    abstract function calculateArea();

    abstract public function calculatePerimeter();

    public function setColor($color) {
        $this->color = $color;
    }

    static function getUsage() {
        echo static::DOMAIN . ' - ' . static::$SUBDOMAIN;
        //echo static::DOMAIN . ' - ' . self::$SUBDOMAIN;
    }
}