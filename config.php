<?php

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    define('HOST', 'https://' . $_SERVER['HTTP_HOST'] . '/projet_04/');
} else {
    define('HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/projet_04/');
}

define('ROOT', __DIR__ . DIRECTORY_SEPARATOR); // DIR is the folder where we can find the file calling the constant

define('CORE', ROOT . 'core' . DIRECTORY_SEPARATOR);
define('LOG', ROOT . 'logs' . DIRECTORY_SEPARATOR);

define('VIEWFRONT', ROOT . 'view' . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR);
define('VIEWBACK', ROOT . 'view' . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR);
define('TEMPLATE', ROOT . 'view' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
define('ASSETS', HOST . 'public/');