<?php

// namespace Math\projet04\classes;

// use Math\projet04\controller\Home;


/**
 *  Classe Routeur
 * 
 *  Create routes and find controller
 */

class Routeur
{
    protected $_request;

    protected $_routes = [ 
        'home' => ['controller' => 'HomeController', 'method' => 'showHome'],
        'post'  => ['controller' => 'PostController', 'method' => 'showPost'],
        'connection'  => ['controller' => 'ConnectionController', 'method' => 'showConnection'],
        'login'  => ['controller' => 'ConnectionController', 'method' => 'loginCheck'],
        'logout'  => ['controller' => 'ConnectionController', 'method' => 'logOut'],
        'edit'  => ['controller' => 'BackController', 'method' => 'showEdit'],
        'add-post'  => ['controller' => 'PostController', 'method' => 'addPost'],
        'update-post'  => ['controller' => 'PostController', 'method' => 'updatePost'],
        'delete-post'  => ['controller' => 'PostController', 'method' => 'deletePostAndComments'],
        'post-management'  => ['controller' => 'BackController', 'method' => 'showPostsManagement'],
        'reported-comments'  => ['controller' => 'BackController', 'method' => 'showReportedComments'],
        'add-comment'  => ['controller' => 'CommentController', 'method' => 'addComment'],
        'delete-comment'  => ['controller' => 'CommentController', 'method' => 'deleteComment'],
        'report-comment'  => ['controller' => 'CommentController', 'method' => 'reportComment'],
        'valid-comment'  => ['controller' => 'CommentController', 'method' => 'validComment']
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

            $currentController = new $controller();
            $currentController->$method($params);

        } else {
            echo '404';
        }
    }
}