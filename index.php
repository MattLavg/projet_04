<?php

require_once('config.php');
require_once(AUTOLOAD . 'Autoloader.php');

use Blog\Model\Autoloader;
use Blog\Core\Routeur;
use Blog\Core\Registry;

session_start();

Autoloader::start();

Registry::setDb($db);

// Routeur's default parameter
if (isset($_GET['page'])) {
    $request = $_GET['page'];
} else {
    $request = 'home';
}

$routeur = new Routeur($request);
$routeur->renderController();


