<?php
    Func::ImportController("Base");

    class LoginController extends BaseController{
        public function Index(){
             View::bind_data("page_title", "login");
             View::bind_data("page_logged", true);
             View::bind_data("page_name_logged", "Admin");
            
             View::bind_data('test', 999);
             View::render($GLOBALS['VIEW_DIR']."/Shared/Header.php");
             View::render($GLOBALS['VIEW_DIR']."/Login/Login.php");
             View::render($GLOBALS['VIEW_DIR']."/Shared/Footer.php");

        }
    }
?>