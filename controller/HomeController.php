<?php 

namespace Blog\Controller;

use Blog\Model\PostManager;
use Blog\Model\Pagination;
use Blog\Core\View;
use Blog\Controller\ConnectionController;

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


