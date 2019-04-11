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

class HomeController
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
        $view->render(array('posts' => $posts), 'front', $pagination, ConnectionController::isSessionValid());
    }
}


