<?php

// namespace Math\projet_04;

require_once('config.php');
require_once(MODEL . 'Autoloader.php');

// use Math\projet04\model\Autoloader;
// use Math\projet_04\application\Routeur;


session_start();


Autoloader::start();

// $autoloader = new Autoloader();
// $autoloader->start();

if (isset($_GET['page'])) {
    $request = $_GET['page'];
} else {
    $request = 'home';
}

$routeur = new Routeur($request);
$routeur->renderController();


