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

        // when add a post
        $actionDone = null;

        if (isset($_SESSION['actionDone'])) {
            $actionDone = $_SESSION['actionDone'];
        }

        $postManager = new PostManager();

        $totalNbRows = $postManager->count();
        $url = HOST . 'home';

        $pagination = new Pagination($pageNb, $totalNbRows, $url, 5);
        
        $posts = $postManager->listPosts($pagination->getFirstEntry(), $pagination->getElementNbByPage());

        $view = new View('home');
        $view->render('front', array(
            'posts' => $posts, 
            'pagination' => $pagination, 
            'isSessionValid' => ConnectionController::isSessionValid(),
            'actionDone' => $actionDone));

        unset($_SESSION['actionDone']);
    }
}


