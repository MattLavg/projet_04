<?php 

// namespace Math\projet04\controller;

// use Math\projet04\Model\PostManager;
// use Math\projet04\Model\Pagination;

// require_once(dirname(__DIR__) . '/model/Manager.php');
// require_once(dirname(__DIR__) . '/model/PostManager.php'); 
// require_once(dirname(__DIR__) . '/model/Pagination.php');

// require_once(MODEL . 'Manager.php');
// require_once(MODEL . 'PostManager.php'); 
// require_once(MODEL . 'Pagination.php');


/**
 * Class Home
 * 
 * Use to show the home
 */

class Home
{
    public function showHome($params = [])
    {   
        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
        } 

        $postManager = new PostManager();

        $totalNbRows = $postManager->count();
        $pagination = new Pagination($pageNb, $totalNbRows, $_SERVER['REQUEST_URI'], 5);
        
        $posts = $postManager->listPosts($pagination->getFirstEntry(), $pagination->getElementNbByPage());

        $view = new View('home');
        $view->render(array('posts' => $posts), 'front', $pagination, $this->isSessionValid());
    }

    public function showPost($params = [])
    {
        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
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
        $view->render(array('post' => $post, 'comments' => $comments), 'front', $pagination, $this->isSessionValid());
    }

    public function showEdit($params)
    {
        if ($this->isSessionValid()) {

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
        if ($this->isSessionValid()) {

            $pageNb = 1;

            if (isset($params['pageNb'])) {
                $pageNb = $params['pageNb'];
            } 

            $postManager = new PostManager();

            $totalNbRows = $postManager->count();
            $pagination = new Pagination($pageNb, $totalNbRows, $_SERVER['REQUEST_URI'], 15);
            
            $posts = $postManager->listPosts($pagination->getFirstEntry(), $pagination->getElementNbByPage());

            $view = new View('postManagement');
            $view->render(array('posts' => $posts), 'back', $pagination, $this->isSessionValid());

        } else {
            echo 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';
        }
    }

    public function showConnection()
    {
        $view = new View('connection');
        $view->render(array(), 'front');
    }

    public function loginCheck($params)
    {
        $authentication = new Authentication();
        $authentication = $authentication->checkLogin();
        // var_dump($params);
        // var_dump($authentication);exit;

        $_SESSION['valid'] = false;
        
        if ($params['name'] == $authentication['name'] && $params['password'] == $authentication['password']) {
            
            $_SESSION['valid'] = true;

            $view = new View();
            $view->redirect('home');

        } else {
            echo 'Les identifiants ne sont pas valides.<br>';
            echo '<a href="' . HOST .'connection">Retour à la page de connexion</a>';
        }
    }

    public function logOut()
    {
        session_destroy();

        $view = new View();
        $view->redirect('home');
    }

    public function isSessionValid()
    {
        if (isset($_SESSION['valid']) && $_SESSION['valid'] == true) {
            return true;
        }

        return false;
    }

    // public function paginationInit($manager, $pageNb, $nbElementsByPage, $post_id = null)
    // {
    //     $totalNbRows = $manager->count($post_id);

    //     $pagination = new Pagination($pageNb, $totalNbRows, $_SERVER['REQUEST_URI'], $nbElementsByPage);

    //     return $pagination;
    // }

    public function addPost($params)
    {
        $manager = new PostManager();
        $manager->addPost($params);

        $view = new View();
        $view->redirect('home');
    }

    public function updatePost($params)
    {
        $manager = new PostManager();
        $post = $manager->updatePost($params);

        // redirect on the updated post
        $view = new View();
        $view->redirect('post/id/' . $params['id']);
    }

    public function deletePostAndComments($params)
    {
        $postManager = new PostManager();
        $postManager->deletePostAndComments($params['id']);

        $view = new View();
        $view->redirect('home');
    }

    public function showReportedComments()
    {
        if ($this->isSessionValid()) {

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


