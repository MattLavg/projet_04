<?php

use Blog\Core\Autoloader;
use Blog\Core\Routeur;
use Blog\Core\Registry;
use Blog\Core\MyException;

require_once('config.php');
require_once('errorHandler.php');
require_once(CORE . 'Autoloader.php');
require_once(CORE . 'MyException.php');

Autoloader::start();

try {
    
    try {
        $db = new \PDO('mysql:host=localhost;dbname=projet04;charset=utf8', 'root', 'root');
    } catch (\Exception $e) {
        throw new MyException('Impossible de se connecter à la base de donnée.');
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

} catch (MyException $e) {

    $_SESSION['errorMessage'] = '<strong>Erreur !</strong><br>' . '<strong>Message :</strong> ' . $e->getMessage() . '<br>';

    $myException = new MyException($e->getMessage(), $e->getCode(), $e->getSeverity(), $e->getFile(), $e->getLine());
    $myException->writeLogs();

    $routeur = new Routeur('error');
    $routeur->renderController();
}