<?php

class ConnectionController
{
    public function showConnection()
    {
        // pour les erreurs
        $errorMessage = null;

        if (isset($_SESSION['errorMessage'])) {
            $errorMessage = $_SESSION['errorMessage'];
        }
// var_dump($errorMessage);exit;
        $view = new View('connection');
        $view->render('front', array('errorMessage' => $errorMessage));

        unset($_SESSION['errorMessage']);
    }

    public function loginCheck($params)
    {
        $authentication = new Authentication();
        $authentication = $authentication->checkLogin();
        // var_dump($params);
        // var_dump($authentication);exit;

        $_SESSION['valid'] = false;
        // var_dump($params);exit;
        if ($params['name'] == $authentication['name'] && $params['password'] == $authentication['password']) {
            
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

    public function logOut()
    {
        session_destroy();

        $view = new View();
        $view->redirect('home');
    }

    public static function isSessionValid()
    {
        if (isset($_SESSION['valid']) && $_SESSION['valid'] == true) {
            return true;
        }

        return null;
    }
}