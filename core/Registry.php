<?php

namespace Blog\Core;

class Registry
{
    protected static $_db;

    public static function getDb()
    {
        return self::$_db;
    }

    public static function setDb($db)
    {
        self::$_db = $db;
    }
}