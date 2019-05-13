<?php

use Blog\Model\Autoloader;
use Blog\Core\Routeur;
use Blog\Core\Registry;

class MonException extends ErrorException
{
  public function __toString()
  {
    switch ($this->severity)
    {
      case E_USER_ERROR : // Si l'utilisateur émet une erreur fatale;
        $type = 'Erreur fatale';
        break;
      
      case E_WARNING : // Si PHP émet une alerte.
      case E_USER_WARNING : // Si l'utilisateur émet une alerte.
        $type = 'Attention';
        break;
      
      case E_NOTICE : // Si PHP émet une notice.
      case E_USER_NOTICE : // Si l'utilisateur émet une notice.
        $type = 'Note';
        break;
      
      default : // Erreur inconnue.
        $type = 'Erreur inconnue';
        break;
    }
    
    return '<strong>' . $type . '</strong> : [' . $this->code . '] ' . $this->message . '<br /><strong>' . $this->file . '</strong> à la ligne <strong>' . $this->line . '</strong>';
  }
}

function error2exception($code, $message, $fichier, $ligne)
{
    throw new MonException($message, 0, $code, $fichier, $ligne);
}

set_error_handler('error2exception');



require_once('config.php');
require_once(AUTOLOAD . 'Autoloader.php');
Autoloader::start();


try {

    $db = new \PDO('mysql:host=localhost;dbname=projet04;charset=utf8', 'root', 'root');
    // $db = new \PDO('mysql:host=boudin.o2switch.net;dbname=mathiasla_projet04;charset=utf8', 'mathiasla_p4', 'A_e409-lrd91_hcol');

    session_start();

    Registry::setDb($db);

    // Routeur's default parameter
    if (isset($_GET['page'])) {
        $request = $_GET['page'];
    } else {
        $request = 'home';
    }

    $routeur = new Routeur($request);
    $routeur->renderController();

} catch (\Exception $e) {

    $_SESSION['errorMessage'] = '<strong>Erreur !</strong><br>' . '<strong>Message :</strong> ' . $e->getMessage() . '<br>';

    $routeur = new Routeur('error');
    $routeur->renderController();
}