<?php

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

define('HOST', 'http://' . $host . '/projet_04/');
define('ROOT', $root . '/projet_04/');

define('CONTROLLER', ROOT . 'controller/');
define('MODEL', ROOT . 'model/');
define('VIEWFRONT', ROOT . 'view/frontend/');
define('VIEWBACK', ROOT . 'view/backend/');
define('CLASSES', ROOT . 'classes/');
define('TEMPLATE', ROOT . 'view/templates/');
define('ASSETS', HOST . 'public/');