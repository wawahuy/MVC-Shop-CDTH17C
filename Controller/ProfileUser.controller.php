<?php
    Func::Import("Model/UserModel.class");

    class ProfileUserController extends BaseController {

        public function Index(){
            if(!Session::IsLogged()) Route::Redirect("/");

            $modeUser = new UserModel();
            $user = $modeUser->GetUserWithID(Session::GetIDLogged());

            View::bind_data("username", $user["member_user"]);
            View::bind_data("email", $user["member_email"]);
            View::bind_data("fullname", $user["member_fullname"]);
            View::bind_data("birthday", $user["member_birth"]);
            View::bind_data("phone", $user["member_phone"]);
            View::bind_data("sex", $user["member_sex"] == "0" ? "Nam" : "Nữ");
            View::bind_data("avatar", $user["member_avatar"] ?? "/Resource/img/account.png");

            parent::renderPage(
                "Thông tin tài khoản",
                $GLOBALS['VIEW_DIR']."/Profile/Layout.php",
                $GLOBALS['VIEW_DIR']."/Profile/User/User.php"
            );
        }

        public function UpdateAvatar(){
            if(!Session::IsLogged()) Route::Redirect("/");

            $file_name = $_FILES['avatar']['name'];
            $file_exte = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
            $file_size = $_FILES["avatar"]["size"];
            $file_type = Func::GetMime($_FILES["avatar"]["tmp_name"]);

            $target_dir_upload = "/Resource/upload/";
            $rand_file_name =  md5(date('Y-m-d H:i:s.') . gettimeofday()['usec']).rand(0, 1000).rand(0, 1000).".".$file_exte;
            $target_file_upload = $target_dir_upload.$rand_file_name;

            if(!preg_match("/^image\//", $file_type)){
                Javascript::InvokeSwal("Lỗi", "Vui lòng upload một hình ảnh!", "error");
                $this->Index();
                return;
            }

            if($file_size > 1024*1024){
                Javascript::InvokeSwal("Lỗi", "Vui lòng upload một hình ảnh >= 1MB!", "error");
                $this->Index();
                return;
            }


            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], dirname(__FILE__)."/..".$target_file_upload)) {
                Javascript::InvokeSwal("Thành công", "Cập nhật hoàn tấc!", "success");
                $modelUser = new UserModel;
                $modelUser->DeleteAvatar(Session::GetIDLogged());
                $modelUser->SetAvatarPathFile(Session::GetIDLogged(), $target_file_upload);
            } else {
                Javascript::InvokeSwal("Lỗi", "Hệ thống gặp vấn đề!", "error");
            }
        
            $this->Index();
        }



        public function ChangePasswordIndex(){
            parent::renderPage(
                "Đổi mật khẩu",
                $GLOBALS['VIEW_DIR']."/Profile/Layout.php",
                $GLOBALS['VIEW_DIR']."/Profile/Password/Password.php"
            );
        }

        public function ChangePasswordSubmit(){
            $modeUser = new UserModel();

            if(strlen($_POST['passnew']) <6 && $_POST['passnew']>32){
                Javascript::InvokeSwal("Lỗi", "Mật khẩu phải >=6 & <=32 kí tự!", "error");
            }
            else
                if($modeUser->NewPassword(Session::GetIDLogged(), ($_POST['passold']), ($_POST['passnew']))){
                    Javascript::InvokeSwal("Thành công", "Đổi mật khẩu thành công!", "success");
                }
                else 
                    Javascript::InvokeSwal("Lỗi", "Mật khẩu cũ không đúng, hoặc bạn sử dụng mật khẩu cũ!", "error");
            
            $this->ChangePasswordIndex();
        }

    }
