<?php

namespace Blog\Model;

use Blog\Core\Manager;

/**
 * Authentication
 * 
 * Allows to check the login in the database
 */

class Authentication extends Manager
{
    /**
     * Allows to check the login in the database
     * 
     * @return array $data
     */
    public function checkLogin()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT name, password FROM login');

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }
}