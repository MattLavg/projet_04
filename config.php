<?php

$db = new \PDO('mysql:host=localhost;dbname=projet04;charset=utf8', 'root', 'root');
// var_dump($_SERVER['DOCUMENT_ROOT'], __DIR__);die;
// get the current directory
// preg_match('#/([a-zA-Z0-9_-]+)+/([a-zA-Z0-9_-]+)*#', $_SERVER['PHP_SELF'], $matches);
// $currentDirectory = $matches[1];

define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/projet_04/');
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR); // DIR correspond au dossier contenant le fichier qui appelle la constante
// define('ROOT', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $currentDirectory . DIRECTORY_SEPARATOR);

define('AUTOLOAD', ROOT . 'model' . DIRECTORY_SEPARATOR);

// define('CONTROLLER', ROOT . 'controller' . DIRECTORY_SEPARATOR);
// define('MODEL', ROOT . 'model' . DIRECTORY_SEPARATOR);
// define('APPLICATION', ROOT . 'application' . DIRECTORY_SEPARATOR);

define('VIEWFRONT', ROOT . 'view' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR);
define('VIEWBACK', ROOT . 'view' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR);
define('TEMPLATE', ROOT . 'view' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define('ASSETS', HOST . 'public/');