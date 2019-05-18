<?php

namespace Blog\Core;

use Blog\Core\View;
use Blog\Core\MyException;

/**
 *  Routeur
 * 
 *  Create routes and find controller
 */

class Routeur
{
    /**
     * @var string the user request
     */
    protected $_request;

    /**
     * @var array routes declaration
     * 
     * Use of full namespace because php does not find the file with dynamic writing
     */
    protected $_routes = [ 
        'home'               => ['controller' => 'Blog\Controller\HomeController',       'method' => 'showHome'],
        'post'               => ['controller' => 'Blog\Controller\PostController',       'method' => 'showPost'],
        'connection'         => ['controller' => 'Blog\Controller\ConnectionController', 'method' => 'showConnection'],
        'login'              => ['controller' => 'Blog\Controller\ConnectionController', 'method' => 'loginCheck'],
        'logout'             => ['controller' => 'Blog\Controller\ConnectionController', 'method' => 'logOut'],
        'edit'               => ['controller' => 'Blog\Controller\BackController',       'method' => 'showEdit'],
        'add-post'           => ['controller' => 'Blog\Controller\PostController',       'method' => 'addPost'],
        'update-post'        => ['controller' => 'Blog\Controller\PostController',       'method' => 'updatePost'],
        'delete-post'        => ['controller' => 'Blog\Controller\PostController',       'method' => 'deletePostAndComments'],
        'post-management'    => ['controller' => 'Blog\Controller\BackController',       'method' => 'showPostsManagement'],
        'reported-comments'  => ['controller' => 'Blog\Controller\BackController',       'method' => 'showReportedComments'],
        'add-comment'        => ['controller' => 'Blog\Controller\CommentController',    'method' => 'addComment'],
        'delete-comment'     => ['controller' => 'Blog\Controller\CommentController',    'method' => 'deleteComment'],
        'report-comment'     => ['controller' => 'Blog\Controller\CommentController',    'method' => 'reportComment'],
        'valid-comment'      => ['controller' => 'Blog\Controller\CommentController',    'method' => 'validComment'],
        'error'              => ['controller' => 'Blog\Controller\ErrorController',      'method' => 'showError']
    ];

    /**
     * Get user request
     * 
     * @param string $request, the user request
     */
    public function __construct($request)
    {
        $this->_request = $request;
    }

    /**
     * Get route
     * 
     * @return string the first element of the array
     */
    public function getRoute()
    {
        $elements = explode('/', $this->_request);
        return $elements[0];
    }

    /**
     * Get "get" or "post" parameters
     * 
     * @return array with get or post parameters
     */
    public function getParams()
    {
        $params = [];
        
        // GET 
        $elements = explode('/', $this->_request); 
        unset($elements[0]);

        // var_dump($elements);
        // echo '<br>';

        for ($i = 1; $i < count($elements); $i++) {

            $params[$elements[$i]] = $elements[$i + 1];
            $i++; // Add another one if more
        }

        // var_dump($params);die;

        // POST
        if ($_POST) {

            foreach ($_POST as $key => $value) {
                $params[$key] = $value;
            }

        }

        return $params;
    }

    /**
     * Get the controller defined by the route with the method defined by the params
     */
    public function renderController()
    {
        $route = $this->getRoute();
        $params = $this->getParams();

        if (key_exists($route, $this->_routes)) {

            $controller = $this->_routes[$route]['controller'];
            $method = $this->_routes[$route]['method'];

            $currentController = new $controller();
            $currentController->$method($params);

        } else {
            throw new MyException('404 : Cette page n\'existe pas.');
        }
    }
}