<?php

namespace Blog\controller;

use Blog\Core\View;
use Blog\Controller\ConnectionController;

/**
 *  ErrorController
 * 
 *  Allows to display errors
 */

class ErrorController 
{
    /**
     * Allows to show the error page
     */
    public function showError() {

        // Default error message to null
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