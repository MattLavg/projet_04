<?php

// use Blog\Core\MyException;

// function errorToException($code, $message, $fichier, $ligne)
// {
//     throw new MyException($message, 0, $code, $fichier, $ligne);
// }

function errorToException($message)
{
    throw new \Exception($message);
}

set_error_handler('errorToException');