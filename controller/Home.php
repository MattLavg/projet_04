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
     
        $pagination = $this->paginationInit($postManager, $pageNb);
        
        $posts = $postManager->listPosts($pagination->getFirstEntry());

        $view = new View('home');
        $view->render(array('posts' => $posts), $pagination, $this->isSessionValid());
    }

    public function showPost($params = [])
    {
        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
        } 

        extract($params); // permet d'extraire la variable $id

        $post_id = $id;

        $postManager = new PostManager();
        $post = $postManager->getPost($post_id);

        $commentsManager = new CommentManager();
        $pagination = $this->paginationInit($commentsManager, $pageNb, $post_id);

        $comments = $commentsManager->listComments($post_id, $pagination->getFirstEntry());

        $view = new View('post');
        $view->render(array('post' => $post, 'comments' => $comments), $pagination, $this->isSessionValid());
    }

    public function showEdit($params)
    {
        if ($this->isSessionValid()) {

            if (isset($params['id'])) {

                extract($params);

                $postManager = new PostManager();
                $post = $postManager->getPost($id);

                $view = new View('edit');
                $view->renderBack(array('post' => $post));
            } else {

                $view = new View('edit');
                $view->renderBack();

            }

        } else {
            echo 'Vous ne pouvez accéder à cette page, veuillez vous connecter.';
        }
    }

    public function showConnection()
    {
        $view = new View('connection');
        $view->render();
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

    public function paginationInit($manager, $pageNb, $post_id = NULL)
    {
        // var_dump($manager);exit;
        $totalNbRows = $manager->count($post_id);

        $pagination = new Pagination($pageNb, $totalNbRows, $_SERVER['REQUEST_URI'], $manager::NB_ELEMENTS_BY_PAGE);

        return $pagination;
    }

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
}

