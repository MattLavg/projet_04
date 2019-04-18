<?php

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

define('HOST', 'http://' . $host . '/projet_04/');
define('ROOT', $root . DIRECTORY_SEPARATOR . 'projet_04' . DIRECTORY_SEPARATOR);

define('AUTOLOAD', ROOT . 'model' . DIRECTORY_SEPARATOR);

define('CONTROLLER', ROOT . 'controller' . DIRECTORY_SEPARATOR);
define('MODEL', ROOT . 'model' . DIRECTORY_SEPARATOR);
define('APPLICATION', ROOT . 'application' . DIRECTORY_SEPARATOR);

define('VIEWFRONT', ROOT . 'view' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR);
define('VIEWBACK', ROOT . 'view' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR);
define('TEMPLATE', ROOT . 'view' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define('ASSETS', HOST . 'public/');