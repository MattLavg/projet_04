<?php

namespace Blog\Model;

use Blog\Model\Comment;
use Blog\Core\Manager;
use Blog\Core\MyException;

/**
 * CommentManager
 * 
 * Allows to list, count, add, update, delete, report and validate comments
 * Allows to list and count reported comments
 * Allows to check if a comment is reported
 */

class CommentManager extends Manager
{
    /**
     * Allows to list the comments
     * 
     * @param int $post_id
     * @param int $firstEntry optionnal
     * @param int $nbElementsByPage
     * 
     * @return array $comments
     */
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

    /**
     * Allows to count comments of a post
     * 
     * @param int $post_id
     * 
     * @return int $totalNbRows
     */
    public function count($post_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS nbRows FROM comments WHERE post_id = ?');
        $req->execute(array($post_id));
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to count the reported comments
     * 
     * @return int $result['nbReportedComments']
     */
    public function countReportedComments()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) nbReportedComments FROM comments WHERE reported = 1');

        $result = $req->fetch();

        return $result['nbReportedComments'];
    }

    /**
     * Allows to list the reported comments
     * 
     * @param int $firstEntry optionnal
     * @param int $nbElementsByPage
     * 
     * @return array $comments
     */
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

        } else {
            throw new MyException('Impossible d\'afficher les commentaires signalés');
        }

        return $comments;
    }

    /**
     * Allows to add a comment
     * 
     * @param array $values
     * @param bool $admin optionnal
     * 
     * @return int the last insert id
     */
    public function addComment($values, $admin = null)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments (post_id, author, content, isAdmin, creationDate) VALUES(?, ?, ?, ?, NOW())');

        if ($admin) {
            $req->execute(array($values['post-id'], $values['author'], $values['content'], 1));
        } else {
            $req->execute(array($values['post-id'], $values['author'], $values['content'], 0));
        }

        $count = $req->rowCount();
        
        if (!$count) {
            throw new MyException('Impossible d\'ajouter le commentaire');
        }

        return $db->lastInsertId();
    }

    /**
     * Allows to delete a comment
     * 
     * @param int $id
     */
    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($id));

        $count = $req->rowCount();

        if (!$count) {
            throw new MyException('Impossible de supprimer le commentaire');
        }
    }

    /**
     * Allows to report a comment
     * 
     * @param int $id
     * 
     * @return bool $reportedComment
     */
    public function reportComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 1 WHERE id = ?');
        $reportedComment = $req->execute(array($id));

        $count = $req->rowCount();

        if (!$count) {
            throw new MyException('Impossible de signaler le commentaire');
        }

        return $reportedComment;
    }

    /**
     * Allows to validate a comment
     * 
     * @param int $id
     */
    public function validComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = 0 WHERE id = ?');
        $req->execute(array($id));

        $count = $req->rowCount();

        if (!$count) {
            throw new MyException('Impossible de valider le commentaire');
        }
    }

    /**
     * Allows to check if a comment is reported
     * 
     * @param int $id
     * 
     * @return array $data
     */
    public function isReportedComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT reported FROM comments WHERE id = ?');
        $req->execute(array($id));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }
}