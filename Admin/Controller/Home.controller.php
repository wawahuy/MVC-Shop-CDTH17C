<?php

    class HomeController extends BaseController {

        public function Index(){
            if(!Session::IsAdminLogged()){
                Route::Redirect("/login");
            }

            #Render View
            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Home/Layout.php',
                dirname(__FILE__).'/../View/Statistical/Statistical.php'
            );
        }

    }


?>

