<?php

namespace Blog\Controller;

use Blog\Core\View;
use Blog\Model\Authentication;

/**
 *  ConnectionController
 * 
 *  Allows to show the connection page, to check the login, to log out and to check if the connection is valid
 */

class ConnectionController
{
    /**
     * Allows to show the connection page
     */
    public function showConnection()
    {
        if ($this->isSessionValid()) {

            $view = new View();
            $view->redirect('post-management');

        } else {

            // Default error message to null
            $errorMessage = null;

            // if user try to connect with empty fields or wrong name and password
            if (isset($_SESSION['errorMessage'])) {
                $errorMessage = $_SESSION['errorMessage'];
            }

            $view = new View('connection');
            $view->render('front', array('errorMessage' => $errorMessage));

            unset($_SESSION['errorMessage']);
        }
    }

    /**
     * Allows to check the login in the database
     * 
     * @param array $params
     */
    public function loginCheck($params)
    {
        $authentication = new Authentication();
        $authentication = $authentication->checkLogin();

        // Default SESSION['valid'] to false
        $_SESSION['valid'] = false;

        if ($params['name'] == $authentication['name'] && password_verify($params['password'], $authentication['password'])) {
            
            $_SESSION['valid'] = true;

            $view = new View();
            $view->redirect('post-management');

        } elseif (empty($params['name']) || empty($params['password'])) {

            $_SESSION['errorMessage'] = 'Veuillez renseigner les identifiants.';

            $view = new View();
            $view->redirect('connection');
            
        } else {

            $_SESSION['errorMessage'] = 'Les identifiants ne sont pas valides.';

            $view = new View();
            $view->redirect('connection');
        }
    }

    /**
     * Allows to log out
     */
    public function logOut()
    {
        session_destroy();

        $view = new View();
        $view->redirect('home');
    }

    /**
     * Allows to check if the connection is valid
     * 
     * @return true|null
     */
    public static function isSessionValid()
    {
        if (isset($_SESSION['valid']) && $_SESSION['valid'] == true) {
            return true;
        }

        return null;
    }
}