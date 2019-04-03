<?php

// namespace Math\projet04;

// use Math\projet04\classes\Routeur;

session_start();

require_once('config.php');

Autoloader::start();

if (isset($_GET['page'])) {
    $request = $_GET['page'];
} else {
    $request = 'home';
}

$routeur = new Routeur($request);
$routeur->renderController();


