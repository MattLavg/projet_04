<?php


$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

define('HOST', 'http://' . $host . '/projet_04/');
define('ROOT', $root . '/projet_04/');

define('CONTROLLER', ROOT . 'controller/');
define('MODEL', ROOT . 'model/');
define('VIEW', ROOT . 'view/');
define('CLASSES', ROOT . 'classes/');

define('ASSETS', HOST . 'public/');
