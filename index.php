<?php

// namespace Math\projet04;

// use Math\projet04\classes\Routeur;

session_start();

require_once('config.php');
require_once(MODEL . 'Autoloader.php');

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


