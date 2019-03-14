<?php

namespace Math\projet04\Model;

class Authentication extends Manager
{
    public function checkLogin()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT name, password FROM login');
        return $req;
    }
}