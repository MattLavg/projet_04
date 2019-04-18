<?php 

namespace controller;


// require_once(MODEL . 'PostManager.php'); 
// require_once(MODEL . 'Pagination.php');
// require_once(APPLICATION . 'View.php');
// require_once(CONTROLLER . 'ConnectionController.php');

use model\PostManager;
use model\Pagination;
use application\View;
use controller\ConnectionController;

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
        $view->render('front', array(
            'posts' => $posts, 
            'pagination' => $pagination, 
            'isSessionValid' => ConnectionController::isSessionValid()));
    }
}


