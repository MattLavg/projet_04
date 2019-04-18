<?php

namespace model;

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

        require_once ROOT . $class . '.php';
    }
}