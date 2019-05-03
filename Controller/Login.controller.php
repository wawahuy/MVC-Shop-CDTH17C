<?php
    Func::Import("Model/UserModel.class");

    class LoginController extends BaseController {

        /**
         * Hành động măc đinh khi truy cập trang Login
         *
         * @return void
         */
        public function Index(){
            if(Session::IsLogged()) Route::Redirect('/');
            $this->render("Đăng nhập");
        }


        /**
         * Hiện thị Page
         *
         * @param string $title
         * @return void
         */
        private function render($title){
            $user = Cookie::Get("umem") ?? $_POST['email'] ?? "";
            $pass = Cookie::Get("pmem") ?? $_POST['pass'] ?? "";
            $save = Cookie::Get("cmem") ?? $_POST['saveinfo'] ?? "";

            View::bind_data("user", $user);
            View::bind_data("pass", $pass);
            View::bind_data("save", $save);

            parent::renderPage(
                "SShop - $title",
                "{$GLOBALS['VIEW_DIR']}/Shared/Layout.php",
                "{$GLOBALS['VIEW_DIR']}/Auth/Login.php"
            );
        }


        /**
         * Hành động đăng xuất
         *
         * @return void
         */
        public function Logout(){
            if(!Session::IsLogged()) Route::Redirect('/login');
            Session::SetLoggedID(null);
            Session::DestroyAll();
            Cookie::Del("islogged");
            Javascript::InvokeScript("swal('Thông báo', 'Đăng xuất thành công!', 'success')");
            $this->render("Đăng xuát");
        }


        /**
         * Hành động này được gọi ở bất kì page nào
         * Chú ý cấu hình ở Route.config.php
         *
         * @return void
         */
        public function AutoLogin(){
            if(!Cookie::Exists("islogged")
                || Session::IsLogged() 
                || !Cookie::Exists("cmem")) return;

            $email = Cookie::Get("umem") ?? "";
            $pass = Cookie::Get("pmem") ?? "";
            $id = $this->testLogin($email, $pass);
            if($id == -1){
                Cookie::Del("cmem");
            }
        }



        /**
         * Khi người dùng tiens hành đăng nhập
         *
         * @return void
         */
        public function LoginSubmit(){
            if(!isset($_POST['email']) || !isset($_POST['pass'])) Route::Redirect('/login');

            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $id = $this->testLogin($email, $pass);

            if($id == -1){
                Javascript::InvokeScript("swal('Lỗi', 'Đăng nhập thất bại!', 'error')");
                $this->render("Đăng nhập");
            }
            else {
                if(isset($_POST['saveinfo']) && $_POST['saveinfo'] == "1"){
                    Cookie::Set("umem", $email);
                    Cookie::Set("pmem", $pass);
                    Cookie::Set("cmem", 1);
                    Cookie::Set("islogged", 1);
                }
                else {
                    Cookie::Del("umem");
                    Cookie::Del("pmem");
                    Cookie::Del("cmem");
                }
                Javascript::InvokeScript("swal('Thông báo', 'Đăng nhập thành công!', 'success')");
                Javascript::InvokeRedirect("{$GLOBALS['YUH_URI_ROOT']}", 1500);
            }
            $this->render("Đăng nhập");
        }




        /**
         * Kiểm tra đăng nhập
         *
         * @param String $email
         * @param String $pass
         * @return integer
         */
        private function testLogin(String $email, String $pass) : int {
            $model = new UserModel();
            $id = null;
            
            #Check if email
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if($model->InvalidLoginEmail($email, $pass)){
                    return -1;
                }
                $id = $model->GetIDWithEmail($email);
            }   

            #Check if username
            else if (preg_match("/^[a-zA-Z0-9_]+$/",$email)) {
                if($model->InvalidLoginUsername($email, $pass) == true){
                    return -1;
                }
                $id = $model->GetIDWithUsername($email);
            }
            else  if (preg_match("/^[^\d|\w_]*$/",$email)) {
                return -1;
            }

            Session::SetLoggedID($id);
            return $id;
        }



        public function LoginApp($params){
            Javascript::InvokeScript("swal('Thông báo', 'Chức năng đang xây dựng!', 'warning')");
            $this->render("Đăng nhập");
        }
    }


?>

