<?php

namespace Blog\controller;

use Blog\Core\View;
use Blog\Controller\ConnectionController;

class ErrorController {

    public function showError() {

        // when error
        $errorMessage = null;

        if (isset($_SESSION['errorMessage'])) {
            $errorMessage = $_SESSION['errorMessage'];
        }

        $view = new View('error');

        if (!ConnectionController::isSessionValid()) {
            $view->render('front', array('errorMessage' => $errorMessage));
        } else {
            $view->render('back', array('errorMessage' => $errorMessage));
        }

        unset($_SESSION['errorMessage']);

    }

}