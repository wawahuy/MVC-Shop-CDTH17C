<?php

    /**
     * Lớp trừu tượng controller
     * Controller bao gồm các Action với nhiệm vụ nhất định nào đó
     * Các phương thức (method) public trong class đều là các Action
     * Index() là Action mặc định
     * 
     * Cách kết hợp nó với Route
     *      Route::<method>(path, "PathController(NameClass)->NameMetod");
     * 
     * PHP Version >= 7.0.33
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
            View::bind_data("page_logged", Session::IsAdminLogged());
            View::bind_data("page_name_logged", "Test");
            View::bind_data("page_code_body", View::get_code_compile($path_content));
            View::render($path_layout);
            Javascript::Run();
        }


    }

?>