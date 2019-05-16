<?php

use Blog\Core\MyException;

// function errorToException($code, $message, $fichier, $ligne)
// {
//     throw new MyException($message, 0, $code, $fichier, $ligne);
// }

function errorToException($code, $message, $fichier, $ligne)
{
    throw new Exception($message, 0, $code, $fichier, $ligne);
}

set_error_handler('errorToException');