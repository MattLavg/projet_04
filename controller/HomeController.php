<?php 

namespace Blog\Controller;

use Blog\Model\PostManager;
use Blog\Model\Pagination;
use Blog\Core\View;
use Blog\Controller\ConnectionController;

/**
 * HomeController
 * 
 * Allows to show the home
 */

class HomeController
{
    /**
     * Allows to show the home
     * 
     * @param array $params optionnal
     */
    public function showHome($params = [])
    {   
        $pageNb = 1;

        if (isset($params['pageNb'])) {
            $pageNb = $params['pageNb'];
        } 

        // Default action message to null
        $actionDone = null;

        // if user add or delete a post
        if (isset($_SESSION['actionDone'])) {
            $actionDone = $_SESSION['actionDone'];
        }

        $homeImage = true;

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
            'actionDone' => $actionDone,
            'homeImage' => $homeImage));

        unset($_SESSION['actionDone']);
    }
}


