<?php

class BackController
{
    public function showEdit($params)
    {
        if (ConnectionController::isSessionValid()) {

            if (isset($params['id'])) {

                extract($params);

                $postManager = new PostManager();
                $post = $postManager->getPost($id);

                $view = new View('edit');
                $view->render('back', array('post' => $post));
            } else {

                $view = new View('edit');
                $view->render('back', array());

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
            $pagination = new Pagination($pageNb, $totalNbRows, $_SERVER['REQUEST_URI'], 15);
            
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
    
    public function showReportedComments()
    {
        if (ConnectionController::isSessionValid()) {

            $pageNb = 1;

            if (isset($params['pageNb'])) {
                $pageNb = $params['pageNb'];
            } 

            $commentManager = new CommentManager();

            $totalNbRows = $commentManager->countReportedComments();
            $pagination = new Pagination($pageNb, $totalNbRows, $_SERVER['REQUEST_URI'], 5);

            $reportedComments = $commentManager->listReportedComments($pagination->getFirstEntry(), $pagination->getElementNbByPage());

            $view = new View('reportedComments');
            $view->render('back', array(
                'reportedComments' => $reportedComments, 
                'pagination' => $pagination));

        } else {
            
            $_SESSION['errorMessage'] = 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';

            $view = new View();
            $view->redirect('connection');
        }
    }
}