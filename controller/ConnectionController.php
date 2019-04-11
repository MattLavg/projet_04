<?php

class ConnectionController
{
    public function showConnection()
    {
        $view = new View('connection');
        $view->render(array(), 'front');
    }

    public function loginCheck($params)
    {
        $authentication = new Authentication();
        $authentication = $authentication->checkLogin();
        // var_dump($params);
        // var_dump($authentication);exit;

        $_SESSION['valid'] = false;
        
        if ($params['name'] == $authentication['name'] && $params['password'] == $authentication['password']) {
            
            $_SESSION['valid'] = true;

            $view = new View();
            $view->redirect('home');

        } else {
            echo 'Les identifiants ne sont pas valides.<br>';
            echo '<a href="' . HOST .'connection">Retour à la page de connexion</a>';
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

        return false;
    }
}