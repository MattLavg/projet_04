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

            if ($commentId) {
                $_SESSION['actionDone'] = 'Votre commentaire a bien été publié.';
            }

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

        $_SESSION['actionDone'] = 'Vous avez supprimé un commentaire.';

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
        $isReportedComment = $commentManager->isReportedComment($params['id']);

        if ($isReportedComment['reported'] == 1) {

            $_SESSION['actionDone'] = 'Le commentaire a déjà été signalé.';

        } else {

            $reportedComment = $commentManager->reportComment($params['id']);

            if ($reportedComment) {
                $_SESSION['actionDone'] = 'Le commentaire a bien été signalé.';
            }

        }

        $view = new View();
        $view->redirect('post/id/' . $params['post-id']);
    }

    public function validComment($params)
    {
        $commentManager = new CommentManager();
        $commentManager->validComment($params['id']);

        $_SESSION['actionDone'] = 'Le commentaire a été publié.';

        if (isset($params['post-id'])) {
            $view = new View();
            $view->redirect('post/id/' . $params['post-id']);
        } else {
            $view = new View();
            $view->redirect('reported-comments');
        }
    }
}