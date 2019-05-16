<?php

    class ProfileUserController extends BaseController {

        public function Index(){
            parent::renderPage(
                "Thông tin tài khoản",
                $GLOBALS['VIEW_DIR']."/Profile/Layout.php",
                $GLOBALS['VIEW_DIR']."/Profile/User/User.php"
            );
        }

        public function Update(){
        }

    }

?>