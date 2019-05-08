<?php
    Func::Import("Model/UserModel.class");
    Func::Import("Model/ConfigModel.class");
    Func::Import("Model/BagModel.class");

    /**
     * Lớp trừu tượng controller
     * Controller bao gồm các Action với nhiệm vụ nhất định nào đó
     * Các phương thức (method) public trong class đều là các Action
     * Index() là Action mặc định
     * 
     * Cách kết hợp nó với Route
     *      Route::<method>(path, "Controller:<name>[@action]");
     *      Chú thích:
     *          method: get|post|all
     *          name:   tên controller, có class AbcController => name là Abc
     *          action: không có nó sẽ gọi action Index, nếu tồn tại @... nó sẽ gọi ->....
     * 
     * PHP Version >= 7.0.33
     * 
     * 
     * 
     */
    abstract class BaseController {

        /* Action chính
         * 
         */
        abstract public function Index();



        /* Render trang web với layout và data layout được bind sẵn
         * param:
         *      $title: tiêu đề trang web <title>$title</title>
         *      $path_layout: layout của trang web
         *      $path_content: nội cung của trang web
         * 
         * 
         */
        protected function renderPage($title, $path_layout, $path_content){
            #Bind Data Page
            View::bind_data("page_title", $title);
            View::bind_data("page_menu", (new ConfigModel)->getsJsonMenu());
            View::bind_data("page_logged", Session::IsLogged());
            View::bind_data("page_logged_id", Session::GetIDLogged());
            View::bind_data("page_name_logged", Session::IsLogged() ? (new UserModel)->GetFullNameWithID(Session::GetIDLogged()) : null);
            View::bind_data("page_code_body", View::get_code_compile($path_content));
            View::bind_data("page_cart_product", (new BagModel)->getNumProduct());
            View::render($path_layout);
            Javascript::Run();
        }

    }

?>