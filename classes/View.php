<?php

class View
{
    protected $_template;

    public function __construct($template = null)
    {
        $this->_template = $template;
    }

    public function render($params = array(), $pagination = null, $isSessionValid = null)
    {
        // foreach ($params as $name => $value) {
        //     ${name} = $value;
        // }
// print_r($params); exit;
        extract($params);
        // var_dump($params);exit;

        $template = $this->_template;

        ob_start();
        require(VIEWFRONT . $template . '.php');
        $content = ob_get_clean();

        require(TEMPLATE . 'front.php');
    }

    public function renderBack($params = array(), $pagination = null, $isSessionValid = null)
    {
        extract($params);

        $template = $this->_template;

        ob_start();
        require(VIEWBACK . $template . '.php');
        $content = ob_get_clean();

        require(TEMPLATE . 'back.php');
    }

    public function redirect($route)
    {
        header('location: ' . HOST . $route);
        exit;
    }
}