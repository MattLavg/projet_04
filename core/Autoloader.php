<?php

namespace Blog\Core;

class Autoloader
{
    public static function start()
    {
        spl_autoload_register(__CLASS__ . '::load');
    }

    public static function load($class)
    {
        // $class = path of the class with namespace
        $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
// var_dump($class);
        $class = substr_replace($class, "", 0, 5); // delete "Blog/" namespace part
        $class = lcfirst($class);
// var_dump($class);die;
        require_once ROOT . $class . '.php';
    }
}