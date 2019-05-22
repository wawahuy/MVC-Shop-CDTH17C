<?php

    class HomeController extends BaseController {

        public function Index(){
            

            #Render View
            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Home/Home.php'
            );
        }

    }


?>

