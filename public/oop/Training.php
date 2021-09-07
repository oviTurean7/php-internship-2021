<?php

namespace App\Training;

class Training
{
    private array $data = [];
    private string $name = '';
    private string $color = '';
    private int $nr = 0;

    public function __construct($name, $color, $nr)
    {
        $this->name = $name;
        $this->color = $color;
        $this->data = [$name, $color, $nr];
    }

    public function __destruct()
    {
        echo 'Destroying: ', $this->name, PHP_EOL;
    }

    public function __set($name, $value)
    {
        echo "Setting $name to $value\n";
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        echo "Getting $name \n";
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else {
            return null;
        }
    }

    public function __call($name, $arguments)
    {
        echo "Calling object method '$name' "
            . implode(', ', $arguments) . "\n";
    }


    public static function __callStatic($name, $arguments)
    {
        echo "Calling static method '$name' "
            . implode(', ', $arguments) . "\n";
    }

    public function __isset($name)
    {
        echo "Is '$name' set?\n";
        return isset($this->data[$name]);
    }


    public function __unset($name)
    {
        echo "Unsetting '$name'\n";
        unset($this->data[$name]);
    }

    public function __toString()
    {
        echo "Is string\n";
        return $this->name;
    }

    public function __invoke($data): bool
    {
        echo "'$data' is callable\n";
        return is_callable($data);
    }

    public static function __set_state($data)
    {
        echo "Exported object '$data'\n";
        return var_export($data);
    }

    public function __debugInfo()
    {
        return ['Object' => $this->data];
    }

    public function __sleep()
    {
        return ['color'];
    }

    public function __wakeup()
    {
        echo 'works ';
    }

    public function magic_const()
    {
        echo __LINE__, '<br>';
        echo __FILE__, '<br>';
        echo __DIR__, '<br>';
        echo __FUNCTION__, '<br>';
        echo __CLASS__, '<br>';
        echo __METHOD__, '<br>';
        echo __NAMESPACE__, '<br>';
    }
}

