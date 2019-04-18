<?php

namespace application;

// require_once(CONTROLLER . 'HomeController.php');
// require_once(MODEL . 'PostManager.php');

// use Math\projet_04\model\PostManager;

// use controller\HomeController;
// use controller\PostController;
// use controller\CommentController;
// use controller\ConnectionController;
// use controller\BackController;




/**
 *  Classe Routeur
 * 
 *  Create routes and find controller
 */

class Routeur
{
    protected $_request;

    /**
     * @var array déclaration des routes
     * précision sur la clé controller : utilisation du namespace complet puisque PHP ne trouve pas le fichier en écriture dynamique
     */
    protected $_routes = [ 
        'home' => ['controller' => 'controller\HomeController', 'method' => 'showHome'],
        'post'  => ['controller' => 'controller\PostController', 'method' => 'showPost'],
        'connection'  => ['controller' => 'controller\ConnectionController', 'method' => 'showConnection'],
        'login'  => ['controller' => 'controller\ConnectionController', 'method' => 'loginCheck'],
        'logout'  => ['controller' => 'controller\ConnectionController', 'method' => 'logOut'],
        'edit'  => ['controller' => 'controller\BackController', 'method' => 'showEdit'],
        'add-post'  => ['controller' => 'controller\PostController', 'method' => 'addPost'],
        'update-post'  => ['controller' => 'controller\PostController', 'method' => 'updatePost'],
        'delete-post'  => ['controller' => 'controller\PostController', 'method' => 'deletePostAndComments'],
        'post-management'  => ['controller' => 'controller\BackController', 'method' => 'showPostsManagement'],
        'reported-comments'  => ['controller' => 'controller\BackController', 'method' => 'showReportedComments'],
        'add-comment'  => ['controller' => 'controller\CommentController', 'method' => 'addComment'],
        'delete-comment'  => ['controller' => 'controller\CommentController', 'method' => 'deleteComment'],
        'report-comment'  => ['controller' => 'controller\CommentController', 'method' => 'reportComment'],
        'valid-comment'  => ['controller' => 'controller\CommentController', 'method' => 'validComment']
    ];

    public function __construct($request)
    {
        $this->_request = $request;
        // echo $request; exit;
    }

    public function getRoute()
    {
        $elements = explode('/', $this->_request);
        return $elements[0];
    }

    public function getParams()
    {
        $params = null;
        
        // GET 
        $elements = explode('/', $this->_request); 
        unset($elements[0]);

        // var_dump($elements);
        // echo '<br>';

        for ($i = 1; $i<count($elements); $i++) {

            $params[$elements[$i]] = $elements[$i + 1];
            $i++; // Ajoute encore un si autres à la suite
            // var_dump($i);exit;
        }

        // var_dump($params);exit;

        if (!isset($params)) {
            $params = [];
        }

        // POST
        if ($_POST) {

            foreach ($_POST as $key => $value) {
                $params[$key] = $value;
            }

        }

        return $params;
    }

    public function renderController()
    {
        $route = $this->getRoute();
        $params = $this->getParams();

        // $request = $this->_request;

        if (key_exists($route, $this->_routes)) {

            $controller = $this->_routes[$route]['controller'];
            $method = $this->_routes[$route]['method'];
            // new PostManager();die;
            // new HomeController();die;
            // var_dump($controller);die;
            $currentController = new $controller();
            $currentController->$method($params);

        } else {
            echo '404';
        }
    }
}