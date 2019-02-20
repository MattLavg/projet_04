<?php

namespace Math\projet04\Model;

// require_once(__DIR__ . '/Manager.php');

class PostManager extends Manager
{

    public function listPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updateDateFr FROM posts ORDER BY creationDate DESC');

        return $req;
    }

    public function getPost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updateDateFr FROM posts WHERE id = ?');
        $req->execute(array($id));

        return $req;
    }

    public function addPost($title, $author, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title, author, content, creationDate, updateDate) VALUES(?, ?, ?, NOW(), ?)');

        $content = strip_tags($content);

        $req->execute(array($title, $author, $content, NULL));
    }

    public function updatePost($id, $title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, updateDate = NOW() WHERE id = ?');

        $content = strip_tags($content);

        $req->execute(array($title, $content, $id));
    }

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($id));
    }

}
