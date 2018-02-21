<?php

class Config {
    const LOG_LEVEL_DEBUG            = 0;
    const LOG_LEVEL_INFO             = 1;
    const LOG_LEVEL_WARNING          = 2;
    const LOG_LEVEL_ERROR            = 3;
    const LOG_LEVEL_FATAL            = 4;

    //Dy
    /*
    static $MERCHANT_LOGIN_ID           = "463ysXYsA6K";
    static $MERCHANT_TRANSACTION_KEY    = "4FP5778k3wyL6q4P";
    */

    //brennan
    static $MERCHANT_LOGIN_ID           = "8eMVbEtZe23s";
    static $MERCHANT_TRANSACTION_KEY    = "9gFt8RAx3zS735Gr";
    static $TRANSACTION_AMOUNT          = array(
                                                    "AMOUNT_TEST"          =>  0.01,
                                                    "AMOUNT_PAYCHECK"      =>  0.02,
                                                    "AMOUNT_SLIP"          =>  0.01,
                                                    "AMOUNT_SUPER_EXTRA"   =>  0.03
                                          );

    static $IS_PRODUCTION               = true;
    static $LOG_FILE                    = "/home/realpaystubdownl/public_html/logs/LOG_";
    static $LOG_LEVEL                   = Config::LOG_LEVEL_INFO;
    static $LOG_MULTILNE                = true;
    static $PDF_LOCATION                = "temp";
}
