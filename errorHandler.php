<?php

use Blog\Core\MyException;

// function errorToException($code, $message, $fichier, $ligne)
// {
//     throw new MyException($message, 0, $code, $fichier, $ligne);
// }

// function writeLogs($code, $message, $file, $line) {

//     $text = date('Y-m-d H:i:s') . ' - Error code : ' . $code . ', message : ' . $message . ', in file : ' . $file . ', line : ' . $line ."\r\n";

//     $logFile = fopen(LOG . 'logs.txt', 'a+');
//     $logLine = fgets($logFile);
//     fputs($logFile, $text);
//     fclose($logFile);
// }

function errorToException($severity, $message, $file, $line)
{
    // var_dump($severity, $message, $file, $line);die;
    // writeLogs($code, $message, $file, $line);
    throw new MyException($message, 0, $severity, $file, $line);
}

// function customException($e)
// {var_dump($e);die;
//     $text = date('Y-m-d H:i:s') . 'Ligne ' . $e->getLine() . ' dans ' . $e->getFile() . ' Exception lancée : ' . $e->getMessage() . "\r\n";
//     echo $text;
//     MyException::writeLogs($text);
// }

set_error_handler('errorToException');
// set_exception_handler('customException');