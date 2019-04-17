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

        } elseif (file_exists(APPLICATION . $class . '.php')) {

            include_once (APPLICATION . $class . '.php');

        } elseif (file_exists(CONTROLLER . $class . '.php')) {

            include_once (CONTROLLER . $class . '.php');

        }
    }
}