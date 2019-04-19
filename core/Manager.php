<?php

namespace Blog\Core;

use Blog\Core\Registry;

class Manager
{
    protected function dbConnect()
    {
        $db = Registry::getDb();
        return $db;
    }
}
