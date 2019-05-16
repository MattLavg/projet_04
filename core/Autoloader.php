<?php

namespace Blog\Core;

/**
 *  Manager
 * 
 *  Allows classes to load automatically without using require or include in other files
 */

class Autoloader
{
    /**
     * Catch the class and launch the load function
     */
    public static function start()
    {
        spl_autoload_register(__CLASS__ . '::load');
    }

    /**
     * Load the class
     * 
     * @param string $class
     */
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