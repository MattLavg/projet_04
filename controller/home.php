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
    public function showHome($params)
    {
        if (!isset($_GET['pageNb'])) {
            $_GET['pageNb'] = 1;
        } elseif (isset($_GET['pageNb']) && $_GET['pageNb'] < 1) {
            $_GET['pageNb'] = 1;
        }
        
        $data = new PostManager();
        
        $totalNbRows = $data->count();
        
        $pagination = new Pagination($_GET['pageNb'], $totalNbRows, $_SERVER['PHP_SELF'], $_SERVER['argv'], PostManager::NB_POST_BY_PAGE);
        
        $posts = $data->listPosts($pagination->getFirstEntry());

        $view = new View('home');
        $view->render(array('posts' => $posts), $pagination);
    }

    public function showPost($params)
    {
        extract($params); // permet d'extraire la variable $id
// print_r($params);var_dump($id);exit;        
        $manager = new PostManager();
        $post = $manager->getPost($id);

        $view = new View('post');
        $view->render(array('post' => $post));
    }

    public function updatePost()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $manager = new PostManager();
            $post = $manager->getPost($id);
        } else {
            $post = new Post();
        }

        $view = new View('edit');
        $view->render(array('post' => $post));
    }

    public function addPost()
    {
        $values = $_POST['values'];

        $manager = new PostManager();
        $manager->addPost($values);

        $view = new View();
        $view->redirect('home.html');
    }
}

