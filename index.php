<?php

require_once('config.php');
require_once(CLASSES . '/Routeur.php');

$request = $_GET['page'];

$routeur = new Routeur($request);
$routeur->renderController();


