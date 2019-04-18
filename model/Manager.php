<?php

namespace model;


class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=projet04;charset=utf8', 'root', 'root');
        return $db;
    }
}
