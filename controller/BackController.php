<?php

namespace Blog\Controller;

use Blog\Controller\ConnectionController;
use Blog\Model\PostManager;
use Blog\Model\CommentManager;
use Blog\Model\Pagination;
use Blog\Core\View;

class BackController
{
    public function showEdit($params)
    {
        if (ConnectionController::isSessionValid()) {

            if (isset($params['id'])) {

                $errorMessage = null;

                if (isset($_SESSION['errorMessage'])) {
                    $errorMessage = $_SESSION['errorMessage'];
                }

                extract($params);

                $postManager = new PostManager();
                $post = $postManager->getPost($id);

                $view = new View('edit');
                $view->render('back', array('post' => $post, 'errorMessage' => $errorMessage));

                unset($_SESSION['errorMessage']);

            } else {

                $errorMessage = null;

                if (isset($_SESSION['errorMessage'])) {
                    $errorMessage = $_SESSION['errorMessage'];
                }

                $view = new View('edit');
                $view->render('back', array('errorMessage' => $errorMessage));

                unset($_SESSION['errorMessage']);

            }

        } else {

            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    public function showPostsManagement($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            $pageNb = 1;

            if (isset($params['pageNb'])) {
                $pageNb = $params['pageNb'];
            } 

            $postManager = new PostManager();

            $totalNbRows = $postManager->count();
            $url = HOST . 'post-management';

            $pagination = new Pagination($pageNb, $totalNbRows, $url, 15);
            
            $posts = $postManager->listPosts($pagination->getFirstEntry(), $pagination->getElementNbByPage());

            $view = new View('postManagement');
            $view->render('back', array(
                'posts' => $posts, 
                'pagination' => $pagination,
                'isSessionValid' => ConnectionController::isSessionValid()));

        } else {
            
            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }
    
    public function showReportedComments($params = [])
    {
        if (ConnectionController::isSessionValid()) {

            $pageNb = 1;

            if (isset($params['pageNb'])) {
                $pageNb = $params['pageNb'];
            } 

            // when publish or delete a comment
            $actionDone = null;

            if (isset($_SESSION['actionDone'])) {
                $actionDone = $_SESSION['actionDone'];
            }

            $commentManager = new CommentManager();

            $totalNbRows = $commentManager->countReportedComments();
            $url = HOST . 'reported-comments';

            $pagination = new Pagination($pageNb, $totalNbRows, $url, 10);

            $reportedComments = $commentManager->listReportedComments($pagination->getFirstEntry(), $pagination->getElementNbByPage());

            $view = new View('reportedComments');
            $view->render('back', array(
                'reportedComments' => $reportedComments, 
                'pagination' => $pagination,
                'actionDone' => $actionDone));

            unset($_SESSION['actionDone']);

        } else {
            
            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }
}