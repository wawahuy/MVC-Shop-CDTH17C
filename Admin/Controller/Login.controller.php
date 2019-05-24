<?php
    Func::Import("Model/Admin.Model");

    class LoginController extends BaseController{
        public function Index(){
             parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Login/Login.php'
            );
        }
        public function Submit(){
            $user = $_POST['email'];
            $pass = $_POST['pass'];
            $modelAdmin = new AdminModel;
            $id = $modelAdmin->TestLogin($user, $pass);

            if($id > 0){
                Javascript::InvokeSwal("Đăng nhập thành công", "", "success");
                Session::SetIDAdminLogged($id);
                Javascript::InvokeRedirect(YUH_URI_ROOT."/", 1000);
            }
            else 
                Javascript::InvokeSwal("Đăng nhập không thành công", "", "error");

            $this->Index();
        }


        public function Logout(){
            Javascript::InvokeSwal("Đăng xuất thành công!", "", "success");
            Session::SetIDAdminLogged(null);
            Javascript::InvokeRedirect(YUH_URI_ROOT."/", 1000);
            $this->Index();
        }
    }
?>