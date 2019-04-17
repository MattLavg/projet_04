<?php

// namespace Math\projet04\model;

// require_once(MODEL . 'Manager.php');

// use Math\projet04\model\Manager;

class Authentication extends Manager
{
    public function checkLogin()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT name, password FROM login');

        $data = $req->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
}