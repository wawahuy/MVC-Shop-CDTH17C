<?php
    Func::ImportModel("User");

    class RegisterController extends BaseController {

        public function Index(){
            if(Session::IsLogged()) Route::Redirect('/');
            $this->render();
        }


        private function render(){
            parent::renderPage(
                "SShop - Đăng kí",
                "{$GLOBALS['VIEW_DIR']}/Shared/Layout.php",
                "{$GLOBALS['VIEW_DIR']}/Auth/Reg.php"
            );
        }


        public function RegisterSubmit(){
            if(!isset($_POST['check_reg']) || $_POST['check_reg']!='1') Route::Redirect('/');

            $model = new UserModel();
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $fullname = $_POST['fullname'];
            $phone = $_POST['sdt'];
            $address = $_POST['address'];
            $indentity_card = $_POST['cmnd'];

            if(!$model->InvalidUsername($username)){
                Javascript::InvokeScript("swal('Lỗi', 'Username đã tồn tại', 'error')");
                $this->render();
                return;
            }
            
            if(!$model->InvalidEmail($email)){
                Javascript::InvokeScript("swal('Lỗi', 'Email đã tồn tại', 'error')");
                $this->render();
                return;
            }

            if(!preg_match('/^[\d]{9,12}$/', $indentity_card)){
                Javascript::InvokeScript("swal('Lỗi', 'CMND Không hợp lệ', 'error')");
                $this->render();
                return;
            }
            
            $model->CreateAccount(
                $username,
                $email,
                $password,
                $fullname,
                $phone,
                $address,
                $indentity_card
            );

            Session::SetLoggedID($model->GetIDWithUsername($username));
            Javascript::InvokeScript("swal('Thông báo', 'Đăng kí thành công!', 'success')");
            Javascript::InvokeRedirect("{$GLOBALS['YUH_URI_ROOT']}", 1500);
            $this->render();
        }

    }


?>

