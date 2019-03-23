<?php

// namespace Math\projet04;

// use Math\projet04\classes\Routeur;

require_once('config.php');
require_once(CLASSES . 'Routeur.php');


if (isset($_GET['page'])) {
    $request = $_GET['page'];
} else {
    $request = 'home.html';
}

$routeur = new Routeur($request);
$routeur->renderController();


