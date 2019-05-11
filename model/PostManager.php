<?php

namespace Blog\Model;

use Blog\Core\Manager;
use Blog\Model\Post;

class PostManager extends Manager
{
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

    public function count()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) AS nbRows FROM posts');
        $result = $req->fetch();

        return $totalNbRows = $result['nbRows'];
    }

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

    public function addPost($values)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts (title, author, content, creationDate, updateDate) VALUES(?, ?, ?, NOW(), ?)');
        $content = strip_tags($values['content']);

        $req->execute(array($values['title'], $values['author'], $content, NULL));

        $count = $req->rowCount();
        
        if (!$count) {
            throw new \Exception('Impossible d\'ajouter l\'article');
        }
    }

    public function updatePost($values)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, author = ?, content = ?, updateDate = NOW() WHERE id = ?');

        $content = strip_tags($values['content']);

        $req->execute(array($values['title'],$values['author'], $content, $values['id']));

        $count = $req->rowCount();
        
        if (!$count) {
            throw new \Exception('Impossible de modifier l\'article');
        }
    }

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
