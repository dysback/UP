<?php

require_once "conf.php";

function request($key, $default = "") {
    if(isset($_REQUEST[$key])) {
        return $_REQUEST[$key];
    }
    return $default;
}

/**
 * not yet implemented
 */
function getInvoiceNumber() {
    return rand(100, 1000000);
}

/*
* @return string*
*/
function writeLog($msg, $level = Config::LOG_LEVEL_INFO) {
    if($level >= Config::$LOG_LEVEL) {
      $file = Config::$LOG_FILE . date("Y-m-d") . ".log";
      //if(is_object($msg) || is_array($msg))
      $p = print_r($msg, true);
      if(!Config::$LOG_MULTILNE)
      {
        $p = str_replace(array("\r", "\n"), array("{r}", "{n}"), $p);
      }
      $bytes = file_put_contents($file, date("H:i:s") . " $level $p\n", FILE_APPEND);
    }
}
