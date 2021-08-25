<?php

abstract class Shape
{
    //private $length;
    //private $width;
    private $color;
    protected const DOMAIN = mathematics;
    static $subdomain = "geometry";

    public static function  getUsage() {
        echo static::DOMAIN . '-' . self::$subdomain;
    }


    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    /*private, protected*/
    public function setColor($color): void
    {
        $this->color = $color;
    }



    public abstract function calculateArea();

    public abstract function calculateLength();



}