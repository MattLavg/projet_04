<?php

class View
{
    protected $_view;
    protected $_template;

    public function __construct($view = null)
    {
        $this->_view = $view;
    }

    public function render($params = array(), $template, $pagination = null, $isSessionValid = null)
    {
        // foreach ($params as $name => $value) {
        //     ${name} = $value;
        // }

        extract($params);

        $this->_template = $template;

        $view = $this->_view;

        ob_start();
        if ($template == 'front') {
            require(VIEWFRONT . $view . '.php');
        } else {
            require(VIEWBACK . $view . '.php');
        }
        
        $content = ob_get_clean();

        require(TEMPLATE . $this->_template . '.php');
    }

    // public function renderBack($params = array(), $pagination = null, $isSessionValid = null)
    // {
    //     extract($params);
        
    //     $view = $this->_view;

    //     ob_start();
    //     require(VIEWBACK . $view . '.php');
    //     $content = ob_get_clean();

    //     require(TEMPLATE . 'back.php');
    // }

    public function redirect($route)
    {
        header('location: ' . HOST . $route);
        exit;
    }
}