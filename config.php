<?php

class Autoloader
{
    public static function start()
    {
        spl_autoload_register(__CLASS__ . '::load');

        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];

        define('HOST', 'http://' . $host . '/projet_04/');
        define('ROOT', $root . '/projet_04/');

        define('CONTROLLER', ROOT . 'controller/');
        define('MODEL', ROOT . 'model/');
        define('VIEWFRONT', ROOT . 'view/frontend/');
        define('CLASSES', ROOT . 'classes/');
        define('PAGINATION', ROOT . 'view/pagination-template/');
        define('ASSETS', HOST . 'public/');
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