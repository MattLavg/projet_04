<?php

namespace Blog\Core;

/**
 *  Registry
 * 
 *  Set and get the database connexion
 */

class Registry
{
    /**
     * @var object the connection to the database
     */
    protected static $_db;

    /**
     * Get database connection
     * 
     * @return object
     */
    public static function getDb()
    {
        return self::$_db;
    }

    /**
     * Set database connection
     * 
     * @param object
     */
    public static function setDb($db)
    {
        self::$_db = $db;
    }
}