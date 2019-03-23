<?php 

// namespace Math\projet04\controller;

// use Math\projet04\Model\PostManager;
// use Math\projet04\Model\Pagination;

// require_once(dirname(__DIR__) . '/model/Manager.php');
// require_once(dirname(__DIR__) . '/model/PostManager.php'); 
// require_once(dirname(__DIR__) . '/model/Pagination.php');

require_once(MODEL . 'Manager.php');
require_once(MODEL . 'PostManager.php'); 
require_once(MODEL . 'Pagination.php');


/**
 * Class Home
 * 
 * Use to show the home
 */

class Home
{
    public function showHome()
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

        ob_start();

        require(VIEW . 'frontend/home.php');

        $content = ob_get_clean();

        require(VIEW . 'frontend/template.php');
    }

    public function showPost()
    {
        ob_start();

        require(VIEW . '/frontend/post.php');

        $content = ob_get_clean();

        require(VIEW . '/frontend/template.php');
    }
}


?>

