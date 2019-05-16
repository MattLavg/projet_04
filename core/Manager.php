<?php

namespace Blog\Core;

use Blog\Core\Registry;

/**
 *  Manager
 * 
 *  Get the database connection
 */

class Manager
{
    /**
     * Set the database connection in variable $db
     * 
     * @return object $db
     */
    protected function dbConnect()
    {
        $db = Registry::getDb();
        return $db;
    }
}
