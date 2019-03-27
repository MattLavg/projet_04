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
        'home.html' => ['controller' => 'Home', 'method' => 'showHome'],
        'post.html'  => ['controller' => 'Home', 'method' => 'showPost']
    ];

    public function __construct($request)
    {
        $this->_request = $request;
    }

    public function renderController()
    {
        $request = $this->_request;

        if (key_exists($request, $this->_routes)) {

            $controller = $this->_routes[$request]['controller'];
            $method = $this->_routes[$request]['method'];

            $currentController = new $controller();
            $currentController->$method();

        } else {
            echo '404';
        }
    }
}