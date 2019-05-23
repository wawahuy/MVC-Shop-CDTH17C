<?php
Func::Import("Model/User.Model.php");
    class UserController extends BaseController{
        public function Index(){
            $user = new User();
            $info = $user -> getUsersInfo() ;
            $code_data = "";
            foreach($info as $user_data){
                $code_data.=View::general_code(dirname(__FILE__).'/../View/User/user_data.php',[
                    'username'=>$user_data['member_user'],
                    'fullname'=>$user_data['member_fullname'],
                    'phone'=>$user_data['member_phone']
                ]);

            }
            View::bind_data('list_user',$code_data);
            parent::renderPage(
            "SShop - Trang chủ",
            dirname(__FILE__).'/../View/Home/Layout.php',
            dirname(__FILE__).'/../View/User/User.php'
             
            );
        }

    }

?>