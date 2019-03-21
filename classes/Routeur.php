<?php

/**
 *  Classe Routeur
 * 
 *  Create routes and find controller
 */

class Routeur
{
    protected $_request;

    protected $_routes = [ 'home.html' => 'home', 'post.html' => 'post'];

    public function __construct($request)
    {
        $this->_request = $request;
    }

    public function renderController()
    {
        $request = $this->_request;

        if (key_exists($request, $this->_routes)) {

            $controller = $this->_routes[$request];
            require(CONTROLLER . $request . '.php');

        } else {
            echo '404';
        }
    }
}