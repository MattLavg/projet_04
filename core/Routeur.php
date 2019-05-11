<?php

namespace Blog\Core;

use Blog\Core\View;

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

        for ($i = 1; $i < count($elements); $i++) {

            $params[$elements[$i]] = $elements[$i + 1];
            $i++; // Ajoute encore un si autres à la suite
            // var_dump($i);exit;
        }

        // var_dump($params);die;

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

        if (key_exists($route, $this->_routes)) {

            $controller = $this->_routes[$route]['controller'];
            $method = $this->_routes[$route]['method'];
            // new PostManager();die;
            // new HomeController();die;
            // var_dump($controller);die;
            $currentController = new $controller();
            $currentController->$method($params);

        } else {
            throw new \Exception('404 : Cette page n\'existe pas.');
        }
    }
}