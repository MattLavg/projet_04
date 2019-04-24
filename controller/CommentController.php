<?php

namespace Blog\Controller;

use Blog\Core\View;
use Blog\Model\CommentManager;

class CommentController
{
    public function addComment($params)
    {
        if (!empty($params['author']) && !empty($params['content'])) {

            $commentManager = new CommentManager();

            if (ConnectionController::isSessionValid()) {

                $commentId = $commentManager->addComment($params, $admin = true);

            } else {

                $commentId = $commentManager->addComment($params);

            }
var_dump($commentId);die;
            $view = new View();
            $view->redirect('post/id/' . $params['post-id']);

        } else {

            $_SESSION['errorMessage'] = 'Vous devez renseigner tous les champs du formulaire.';

            $view = new View();
            $view->redirect('post/id/' . $params['post-id']);
        }
    }

    public function deleteComment($params)
    { 
        $commentManager = new CommentManager();
        $commentManager->deleteComment($params['id']);

        if (isset($params['post-id'])) {
            $view = new View();
            $view->redirect('post/id/' . $params['post-id']);
        } else {
            $view = new View();
            $view->redirect('reported-comments');
        }
    }

    public function reportComment($params)
    {
        $commentManager = new CommentManager();
        $commentManager->reportComment($params['id']);

        $view = new View();
        $view->redirect('post/id/' . $params['post-id']);
    }

    public function validComment($params)
    {
        $commentManager = new CommentManager();
        $commentManager->validComment($params['id']);

        if (isset($params['post-id'])) {
            $view = new View();
            $view->redirect('post/id/' . $params['post-id']);
        } else {
            $view = new View();
            $view->redirect('reported-comments');
        }
    }
}