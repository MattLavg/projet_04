<?php

// namespace Math\projet04\Model;

class Autoloader
{
    public static function start()
    {
        spl_autoload_register(__CLASS__ . '::load');
    }

    public static function load($class)
    {
        if (file_exists(MODEL . $class . '.php')) {

            include_once (MODEL . $class . '.php');

        } else if (file_exists(CLASSES . $class . '.php')) {

            include_once (CLASSES . $class . '.php');

        } else if (file_exists(CONTROLLER . $class . '.php')) {

            include_once (CONTROLLER . $class . '.php');

        }
    }
}