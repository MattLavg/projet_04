<?php

class CommentController
{
    public function addComment($params)
    {
        $commentManager = new CommentManager();
        $commentId = $commentManager->addComment($params);

        if (isset($params['main-author'])) {
            $commentManager->isAuthor($commentId);
        }

        $view = new View();
        $view->redirect('post/id/' . $params['post-id']);
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
}