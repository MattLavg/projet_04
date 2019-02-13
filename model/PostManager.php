<?php

namespace Math\projet04\Model;

require_once(__DIR__ . '/Manager.php');

class PostManager extends Manager
{

    public function listPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creationDate DESC');

        return $req;
    }

}
