<?php

require_once('config.php');
require_once(AUTOLOAD . 'Autoloader.php');

use model\Autoloader;
use application\Routeur;


session_start();

Autoloader::start();


if (isset($_GET['page'])) {
    $request = $_GET['page'];
} else {
    $request = 'home';
}

$routeur = new Routeur($request);
$routeur->renderController();


