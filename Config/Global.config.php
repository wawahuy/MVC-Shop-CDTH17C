<?php
    #Phiên bản PHP yêu cầu
    $MIN_VER_PHP = '7.0.33';

    #Thư mục chứa App.php
    $ROOT_DIR = preg_replace('/\/App\.php/', "", $_SERVER['PHP_SELF']);
    $YUH_URI_ROOT = $ROOT_DIR;
    define("YUH_URI_ROOT", $ROOT_DIR);
    define("URI_ROOT", $ROOT_DIR);   

    #Thư mục View
    $VIEW_DIR = $ROOT_DIR.'/View';
    define("VIEW_DIR", $VIEW_DIR);

    #Thư mục Controller
    $CONTROLLER_DIR = $ROOT_DIR.'/Controller';
    define("CONTROLLER_DIR", $CONTROLLER_DIR);

    #Thư mục model
    $MODEL_DIR = $ROOT_DIR.'/Model';
    define("MODEL_DIR", $MODEL_DIR);
?>