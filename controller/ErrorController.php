<?php

namespace Blog\controller;

use Blog\Core\View;

class ErrorController {

    public function showError() {

        // when error
        $errorMessage = null;

        if (isset($_SESSION['errorMessage'])) {
            $errorMessage = $_SESSION['errorMessage'];
        }

        $view = new View('error');
        $view->render('front', array('errorMessage' => $errorMessage));

        unset($_SESSION['errorMessage']);

    }

}