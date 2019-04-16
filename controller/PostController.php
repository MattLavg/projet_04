<?php

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

        if (isset($_SESSION['errorMessage'])) {
            $errorMessage = $_SESSION['errorMessage'];
        }

        extract($params); // permet d'extraire la variable $id

        $postId = $id;

        $postManager = new PostManager();
        $post = $postManager->getPost($postId);

        $commentManager = new CommentManager();

        $totalNbRows = $commentManager->count($postId);
        $pagination = new Pagination($pageNb, $totalNbRows, $_SERVER['REQUEST_URI'], 10);

        $comments = $commentManager->listComments($postId, $pagination->getFirstEntry(), $pagination->getElementNbByPage());

        $view = new View('post');
        $view->render('front', array(
            'post' => $post, 
            'comments' => $comments, 
            'pagination' => $pagination, 
            'isSessionValid' => ConnectionController::isSessionValid(), 
            'errorMessage' => $errorMessage));

        unset($_SESSION['errorMessage']);
    }

    public function addPost($params)
    {
        if (!empty($params['title']) && !empty($params['author']) && !empty($params['content'])) {

            $manager = new PostManager();
            $manager->addPost($params);

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

        $view = new View();
        $view->redirect('home');
    }
}