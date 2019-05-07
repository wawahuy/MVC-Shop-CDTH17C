<?php
    Func::Import("Model/UserModel.class");

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
            $phone = $_POST['phone'];
            $birth = $_POST['birthday'];
            $sex = $_POST['sex'];

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

            if(strlen($password) < 6 || strlen($password) > 32){
                Javascript::InvokeSwal("Lỗi", "Password phải >= 6 & <=32", "error");
                $this->render();
                return;
            }

            if(strlen($fullname) < 2){
                Javascript::InvokeSwal("Lỗi", "Vui lòng nhập một tên đúng!", "error");
                $this->render();
                return;
            }

            if(strlen($phone) < 9 || strlen($phone) > 13){
                Javascript::InvokeSwal("Lỗi", "Sai SĐT!", "error");
                $this->render();
                return;
            }

            if($sex != "0" && $sex != "1" ){
                Javascript::InvokeSwal("Lỗi", "Sai giới tính!", "error");
                $this->render();
                return;
            }

            if (preg_match("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", $birth, $matches)) {
                if (!checkdate($matches[2], $matches[1], $matches[3])) {
                    Javascript::InvokeSwal("Lỗi", "Sai ngày sinh!", "error");
                    $this->render();
                    return;                
                }
            } 
            
            
            $model->CreateAccount(
                $username,
                $email,
                $password,
                $fullname,
                $phone,
                $sex,
                $birth
            );

            Session::SetLoggedID($model->GetIDWithUsername($username));
            Javascript::InvokeScript("swal('Thông báo', 'Đăng kí thành công!', 'success')");
            Javascript::InvokeRedirect("{$GLOBALS['YUH_URI_ROOT']}", 1500);
            $this->render();
        }

    }


?>

