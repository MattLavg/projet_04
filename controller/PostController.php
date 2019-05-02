<?php

namespace Blog\Controller;

use Blog\Model\PostManager;
use Blog\Model\CommentManager;
use Blog\Model\Pagination;
use Blog\Controller\ConnectionController;
use Blog\Core\View;

class PostController 
{
    public function showPost($params = [])
    {
        // pour la pagination
        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
        } 

        // pour les erreurs
        $errorMessage = null;
        // en cas de réussite
        $actionDone = null;

        if (isset($_SESSION['errorMessage'])) {
            $errorMessage = $_SESSION['errorMessage'];
        }

        if (isset($_SESSION['actionDone'])) {
            $actionDone = $_SESSION['actionDone'];
        }

        extract($params); // permet d'extraire la variable $id

        $postId = $id;

        $postManager = new PostManager();
        $post = $postManager->getPost($postId);

        $commentManager = new CommentManager();

        $totalNbRows = $commentManager->count($postId);
        $url = HOST . 'post/id/' . $postId;

        $pagination = new Pagination($pageNb, $totalNbRows, $url, 10);

        $comments = $commentManager->listComments($postId, $pagination->getFirstEntry(), $pagination->getElementNbByPage());

        $view = new View('post');
        $view->render('front', array(
            'post' => $post, 
            'comments' => $comments, 
            'pagination' => $pagination, 
            'isSessionValid' => ConnectionController::isSessionValid(), 
            'errorMessage' => $errorMessage,
            'actionDone' => $actionDone));

        unset($_SESSION['errorMessage'], $_SESSION['actionDone']);
    }

    public function addPost($params)
    {
        if (!empty($params['title']) && !empty($params['author']) && !empty($params['content'])) {

            $manager = new PostManager();
            $manager->addPost($params);

            $_SESSION['actionDone'] = 'Un nouvel article a été ajouté.';

            $view = new View();
            $view->redirect('home');

        } else {

            $_SESSION['errorMessage'] = 'Tous les champs doivent être renseignés.';

            $view = new View();
            $view->redirect('edit');

        }
    }

    public function updatePost($params)
    {
        if (!empty($params['title']) && !empty($params['author']) && !empty($params['content'])) {

            $manager = new PostManager();
            $post = $manager->updatePost($params);

            $_SESSION['actionDone'] = 'L\'article a été modifié.';

            // redirect on the updated post
            $view = new View();
            $view->redirect('post/id/' . $params['id']);

        } else {

            $_SESSION['errorMessage'] = 'Tous les champs doivent être renseignés.';

            $view = new View();
            $view->redirect('edit/id/' . $params['id']);

        }
    }

    public function deletePostAndComments($params)
    { 
        $postManager = new PostManager();
        $postManager->deletePostAndComments($params['id']);

        $_SESSION['actionDone'] = 'Vous avez supprimé un article.';

        if (isset($params['post-management'])) {

            $view = new View();
            $view->redirect('post-management');

        } else {

            $view = new View();
            $view->redirect('home');

        }
    }
}