<?php
// var_dump(isset($_SERVER['HTTPS']));die;
// var_dump($_SERVER['SERVER_PROTOCOL']);die;

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    define('HOST', 'https://' . $_SERVER['HTTP_HOST'] . '/projet_04/');
} else {
    define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/projet_04/');
}

define('ROOT', __DIR__ . DIRECTORY_SEPARATOR); // DIR correspond au dossier contenant le fichier qui appelle la constante

define('CORE', ROOT . 'core' . DIRECTORY_SEPARATOR);

define('VIEWFRONT', ROOT . 'view' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR);
define('VIEWBACK', ROOT . 'view' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR);
define('TEMPLATE', ROOT . 'view' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define('ASSETS', HOST . 'public/');