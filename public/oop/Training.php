<?php

/*
 * __construct, __destruct
• __get, __set
• __call, __callStatic
• __isset, __unset
• __toString
__invoke
• __set_state, __debugInfo
 */


class Training
{
    private $name;
    private $notSerializable;

    public function intParam(int $param) {
        echo "int";
    }

    public function arrParam(array $param) {
        echo "arr";
    }

    public function use() {
        echo __FUNCTION__;
    }

    public function className() {
        echo __CLASS__;
    }

    public function method() {
        echo __METHOD__;
    }

    public function namespace() {
        echo __NAMESPACE__;
    }

    private function test() {

    }

    private static function testStatic() {

    }

    public function __construct()
    {
        echo "hi";
    }

    public function __destruct()
    {
        echo "byeee";
    }

    public function __get($name)
    {
        return " <br>" . $name;
    }

    public function __set($name, $value)
    {
        $this->name = $value;
    }

    public function __call(string $name , array $arguments)
    {
        echo "Call me by your name";
    }

    public static function __callStatic(string $name , array $arguments)
    {
        echo "Static and ecstatic";
    }

    public function __isset($name)
    {
        echo "I'm all set";
    }

    public function __unset($name)
    {
        echo "This is unsettling";
    }

    public function __toString()
    {
        return "Hello, my name is: " . $this->name;
    }

    public function __invoke($name)
    {
        echo "Invoke";
    }

    public static function __set_state($name)
    {
        echo "State";
    }

    public function  __debugInfo()
    {
        echo "Hello, my name is: " . $this->name;
    }

    public function __sleep() {
        return ['name'];
    }

    public function __wakeup() {
        echo '<br> Good morning <br>';
    }
}