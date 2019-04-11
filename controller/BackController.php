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
                $view->render(array('post' => $post), 'back');
            } else {

                $view = new View('edit');
                $view->render(array(), 'back');

            }

        } else {
            echo 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';
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
            $view->render(array('posts' => $posts), 'back', $pagination, ConnectionController::isSessionValid());

        } else {
            echo 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';
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
            $view->render(array('reportedComments' => $reportedComments), 'back', $pagination);

        } else {
            echo 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';
        }
    }
}