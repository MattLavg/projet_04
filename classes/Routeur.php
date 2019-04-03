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
        'home' => ['controller' => 'Home', 'method' => 'showHome'],
        'post'  => ['controller' => 'Home', 'method' => 'showPost'],
        'connection'  => ['controller' => 'Home', 'method' => 'showConnection'],
        'login'  => ['controller' => 'Home', 'method' => 'loginCheck'],
        'logout'  => ['controller' => 'Home', 'method' => 'logOut'],
        'add-post.html'  => ['controller' => 'Home', 'method' => 'addPost'],
        'update-post.html'  => ['controller' => 'Home', 'method' => 'updatePost']
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
        $params = NULL;
        
        // GET 
        $elements = explode('/', $this->_request); 
        // print_r($elements); exit;
        unset($elements[0]);
        // print_r($elements); exit;

        for ($i = 1; $i<count($elements); $i++) {
            $params[$elements[$i]] = $elements[$i + 1];
            $i++; // Ajoute encore un si autres à la suite
        }

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