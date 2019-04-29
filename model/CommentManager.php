<?php

namespace Blog\Model;

use Blog\Model\Comment;
use Blog\Core\Manager;

class CommentManager extends Manager
{
    public function listComments($post_id, $firstEntry = 0, $nbElementsByPage)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, content, reported, isAdmin, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate FROM comments WHERE post_id = ? ORDER BY comments.creationDate DESC LIMIT ' . $firstEntry . ',' . $nbElementsByPage);
        $req->execute([$post_id]);

        $comments = [];

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
  
            $comment = new Comment();
            $comment->hydrate($data);

            $comments[] = $comment;
            
        }

        return $comments;
    }

    public function count($post_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS nbRows FROM comments WHERE post_id = ?');
        $req->execute(array($post_id));
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    public function countReportedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) nbReportedComments FROM comments WHERE reported = 1');

        $result = $req->fetch();

        return $result['nbReportedComments'];
    }

    public function listReportedComments($firstEntry = 0, $nbElementsByPage)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, author, content, reported, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate FROM comments WHERE reported = 1 ORDER BY comments.creationDate DESC LIMIT ' . $firstEntry . ',' . $nbElementsByPage);

        $comments = [];

        if ($req) {

            while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
  
                $comment = new Comment();
                $comment->hydrate($data);
    
                $comments[] = $comment;
                
            }

        }

        return $comments;
    }

    public function addComment($values, $admin = null)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments (post_id, author, content, isAdmin, creationDate) VALUES(?, ?, ?, ?, NOW())');

        $content = strip_tags($values['content']);

        if ($admin) {
            $req->execute(array($values['post-id'], $values['author'], $content, 1));
        } else {
            $req->execute(array($values['post-id'], $values['author'], $content, 0));
        }

        return $db->lastInsertId();
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
        $reportedComment = $req->execute(array($id));

        return $reportedComment;
    }

    public function validComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 0 WHERE id = ?');
        $req->execute(array($id));
    }

    public function isAdmin($id) // voir si toujours utile
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET isAdmin = 1 WHERE id = ?');
        $req->execute(array($id));
    }

    public function isReportedComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT reported FROM comments WHERE id = ?');
        $req->execute(array($id));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }
}