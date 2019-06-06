<?php
Func::Import("Model/User.Model.php");
    class UserController extends BaseController{
        public function Index(){
            $user = new User();
            $info = $user -> getUsersInfo();
            $code_data = "";
            foreach($info as $user_data){
                $code_data.=View::general_code(dirname(__FILE__).'/../View/User/user_data.php',[
                    'id' => $user_data['member_id'],
                    'username'=>$user_data['member_user'],
                    'fullname'=>$user_data['member_fullname'],
                    'phone'=>$user_data['member_phone'],
                    'status'=>$user_data['member_status']
                ]);
            }
            
            View::bind_data('list_user',$code_data);
            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Home/Layout.php',
                dirname(__FILE__).'/../View/User/User.php'
            );
        }

        //xoa khach hàng
        public function user_remove($param){
            $user_info = new User();
            if( $user_info-> user_remove($param['id']))
                Javascript::InvokeSwal('Xóa thành công', '','success');
            $this -> Index();
        }

        //cam khach hàng
        public function user_active($param){
            $user_info = new User();
            if( $user_info-> user_active($param['id']))
                Javascript::InvokeSwal('Cấm thành công', '','success');
            $this -> Index();
        }


        //bo cam khach hàng
        public function user_deactive($param){
            $user_info = new User();
            if( $user_info-> user_deactive($param['id']))
                Javascript::InvokeSwal('Bỏ cấm thành công', '','success');
            $this -> Index();
        }

    }

?>