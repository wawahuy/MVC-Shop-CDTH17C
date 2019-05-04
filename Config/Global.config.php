<?php
    #Phiên bản PHP yêu cầu
    $MIN_VER_PHP = '7.0.33';

    #URI ROOT
    $YUH_URI_ROOT = preg_replace('/\/App\.php/', "", $_SERVER['PHP_SELF']);
    define("YUH_URI_ROOT", $YUH_URI_ROOT);
    define("URI_ROOT", $YUH_URI_ROOT);   

    #Thư mục chứa App.php
    $ROOT_DIR = dirname(__FILE__)."/..";
    

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