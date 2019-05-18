<?php

// use Blog\Core\MyException;

// function errorToException($code, $message, $fichier, $ligne)
// {
//     throw new MyException($message, 0, $code, $fichier, $ligne);
// }

function writeLogs($code, $message, $file, $line) {

    $text = date('Y-m-d H:i:s') . ' - Error code : ' . $code . ', message : ' . $message . ', in file : ' . $file . ', line : ' . $line ."\r\n";

    $logFile = fopen(LOG . 'logs.txt', 'a+');
    $logLine = fgets($logFile);
    fputs($logFile, $text);
    fclose($logFile);
}

function errorToException($code, $message, $file, $line)
{
    // var_dump($code, $message, $file, $line);die;
    writeLogs($code, $message, $file, $line);
    throw new \Exception($message);
}

set_error_handler('errorToException');