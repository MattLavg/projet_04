<?php

class View
{
    protected $_template;

    public function __construct($template)
    {
        $this->_template = $template;
    }

    public function render($posts = null, $pagination)
    {
        $template = $this->_template;

        ob_start();
        require(VIEW . $template . '.php');
        $content = ob_get_clean();

        require(VIEW . 'template.php');
    }
}