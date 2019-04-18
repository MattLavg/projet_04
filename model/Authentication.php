<?php

namespace model;

// require_once(MODEL . 'Manager.php');

use model\Manager;

class Authentication extends Manager
{
    public function checkLogin()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT name, password FROM login');

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }
}