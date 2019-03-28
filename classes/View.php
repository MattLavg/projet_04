<?php

class View
{
    protected $_template;

    public function __construct($template = null)
    {
        $this->_template = $template;
    }

    public function render($params = array(), $pagination = NULL)
    {
        // foreach ($params as $name => $value) {
        //     ${name} = $value;
        // }
// print_r($params); exit;
        extract($params);
        // var_dump($params);exit;

        $template = $this->_template;

        ob_start();
        require(VIEW . $template . '.php');
        $content = ob_get_clean();

        require(VIEW . 'template.php');
    }

    public function redirect($route)
    {
        header('location: ' . HOST . $route);
        exit;
    }
}