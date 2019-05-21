<?php

namespace Blog\Core;

/**
 * MyException
 * 
 * Allows to return error message and to write in log file
 */

 class MyException extends \ErrorException
 {
    /**
     * Allows to convert exception into a string
     * 
     * @return string
     */
    public function __toString()
    {
      switch ($this->severity)
      {
        case E_USER_ERROR : 
          $type = 'Fatal error';
          break;
        
        case E_WARNING : 
        case E_USER_WARNING : 
          $type = 'Warning';
          break;
        
        case E_NOTICE : 
        case E_USER_NOTICE :
          $type = 'Notice';
          break;
        
        default :
          $type = 'Unknown error';
          break;
      }
      
      return date('Y-m-d H:i:s') . ' - ' . $type . ' : [' . $this->code . '], message : "' . $this->message . '", in file : ' . $this->file . ' line : ' . $this->line . "\r\n";
    }

    /**
     * Allows to write in log file
     */
    public function writeLogs()
    {
        $logFile = fopen(LOG . date('Ymd-') . 'logs.log', 'a+');
        $logLine = fgets($logFile);
        fputs($logFile, $this->__toString());
        fclose($logFile);
    }
  }