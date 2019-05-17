<?php

use Blog\Core\Autoloader;
use Blog\Core\Routeur;
use Blog\Core\Registry;

require_once('config.php');
require_once('errorHandler.php');
require_once(CORE . 'Autoloader.php');

Autoloader::start();


try {

    try {
        $db = new \PDO('mysql:host=localhost;dbname=projet04;charset=utf8', 'root', 'root');
        // $db = new \PDO('mysql:host=boudin.o2switch.net;dbname=mathiasla_projet04;charset=utf8', 'mathiasla_p4', 'A_e409-lrd91_hcol');
    } catch (\Exception $e) {
        throw new \Exception('Impossible de se connecter à la base de donnée.');
    }

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