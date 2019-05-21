<?php

namespace Blog\Core;

/**
 *  View
 * 
 *  Display view and template
 */

class View
{
    /**
     * @var string the view defined by the controller
     */
    protected $_view;

    /**
     * @var string the template defined by the controller
     */
    protected $_template;

    /**
     * Set the view defined by the controller in the attribute _view
     * 
     * @param string $view optional
     */
    public function __construct($view = null)
    {
        $this->_view = $view;
    }

    /**
     * Render view and template
     * 
     * @param string $template
     * @param array $params
     */
    public function render($template, $params = [])
    {
        // foreach ($params as $name => $value) {
        //     ${name} = $value;
        // }

        extract($params); 
        // Allows to extract variables from array's keys
        // Ex : from HomeController, allows to extract variables $posts, $pagination, $isSessionValid, $actionDone, $homeImage 

        $this->_template = $template;

        $view = $this->_view;

        ob_start();
        if ($template == 'front') {
            require(VIEWFRONT . $view . '.php'); // search the view in frontend
        } else {
            require(VIEWBACK . $view . '.php'); // search the view in backend
        }
        
        $content = ob_get_clean();

        require(TEMPLATE . $this->_template . '.php');
    }

    /**
     * Redirect on the page defined by the route
     * 
     * @param string $route
     */
    public function redirect($route)
    {
        header('location: ' . HOST . $route);
        exit;
    }
}