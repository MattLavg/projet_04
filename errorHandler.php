<?php

use Blog\Core\MyException;

function errorToException($severity, $message, $file, $line)
{
    throw new MyException($message, 0, $severity, $file, $line);
}

set_error_handler('errorToException');
