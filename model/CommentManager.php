<?php

namespace Math\projet04\Model;

class CommentManager extends Manager
{
    public function listComments($post_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, content, reported, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comments WHERE post_id = ? ORDER BY creationDate DESC');
        $req->execute(array($post_id));

        return $req;
    }

    // public function listReportedComments()
    // {
    //     $db = $this->dbConnect();
    //     $req = $db->query('SELECT * FROM comments WHERE reported = 1 ORDER BY');

    //     return $req;
    // }

    public function addComment($post_id, $author, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments (post_id, author, content, creationDate) VALUES(?, ?, ?, NOW())');

        $content = strip_tags($content);

        $req->execute(array($post_id, $author, $content));
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($id));
    }

    public function reportComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $req->execute(array($id));
    }
}