<?php

    class HomeController extends BaseController {

        public function Index(){
            if(!Session::IsAdminLogged()){
                Route::Redirect("/login");
                return;
            }

            #Render View
            Route::Redirect("/user_management");
        }

    }


?>

