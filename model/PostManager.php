<?php

namespace Blog\Model;

use Blog\Core\Manager;
use Blog\Model\Post;

/**
 *  PostManager
 * 
 *  Allows to list, count, get, add, update and delete posts
 */

class PostManager extends Manager
{
    /**
     * Allows to list the posts
     * 
     * @param int $firstEntry optionnal
     * @param int $nbElementsByPage
     * 
     * @return array $posts
     */
    public function listPosts($firstEntry = 0, $nbElementsByPage)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updateDate FROM posts ORDER BY posts.creationDate DESC LIMIT ' . $firstEntry . ',' . $nbElementsByPage);

        $posts = [];

        if ($req) {

            while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {

                $post = new Post();
                $post->hydrate($data);
    
                $posts[] = $post;
    
            }

        } else {
            throw new \Exception('Impossible d\'afficher la liste des postes');
        }

        return $posts;
    }

    /**
     * Allows to count posts
     * 
     * @return int $totalNbRows
     */
    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM posts');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

    /**
     * Allows to get a post
     * 
     * @param int $id
     * @return object PDOStatement
     */
    public function getPost($id)
    { 
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%imin%ss\') AS updateDate FROM posts WHERE id = ?');
        $req->execute(array($id));

        $data = $req->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            throw new \Exception('Impossible d\'afficher l\'article');
        }

        $post = new Post();
        $post->hydrate($data);

        return $post;
    }

    /**
     * Allows to add a post
     * 
     * @param array $values
     */
    public function addPost($values)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title, author, content, creationDate, updateDate) VALUES(?, ?, ?, NOW(), ?)');

        $req->execute(array($values['title'], $values['author'], $values['content'], NULL));

        $count = $req->rowCount();
        
        if (!$count) {
            throw new \Exception('Impossible d\'ajouter l\'article');
        }
    }

    /**
     * Allows to update a post
     * 
     * @param array $values
     */
    public function updatePost($values)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, author = ?, content = ?, updateDate = NOW() WHERE id = ?');

        $req->execute(array($values['title'],$values['author'], $values['content'], $values['id']));

        $count = $req->rowCount();
        
        if (!$count) {
            throw new \Exception('Impossible de modifier l\'article');
        }
    }

    /**
     * Allows to delete a post with linked comments
     * 
     * @param int $id
     */
    public function deletePostAndComments($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(
        'DELETE P, C 
        FROM posts AS P
        LEFT JOIN comments AS C
        ON C.post_id = P.id
        WHERE P.id = ?
        ');
        $req->execute(array($id));

        $count = $req->rowCount();

        if (!$count) {
            throw new \Exception('Impossible de supprimer l\'article et ses commentaires');
        }
        
    }

}
