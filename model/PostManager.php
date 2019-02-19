<?php

namespace Math\projet04\Model;

// require_once(__DIR__ . '/Manager.php');

class PostManager extends Manager
{

    public function listPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creationDate DESC');

        return $req;
    }

    public function getPost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($id));

        return $req;
    }

    public function addPost($title, $author, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title, author, content, creationDate) VALUES(?, ?, ?, NOW())');

        $content = strip_tags($content);

        $req->execute(array($title, $author, $content));
    }

    public function updatePost($id, $title, $author, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, author = ?, content = ? WHERE id = ?');

        $content = strip_tags($content);

        $req->execute(array($title, $author, $content, $id));
    }

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $req->execute(array($id));
    }

}
