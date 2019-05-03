<?php

    /**
     * Coder: Nguyễn Gia Huy
     * Bắt đầu: 01-04-2019
     * Sửa đổi cuối: 10-04-2019
     * 
     * 
     */

    class Func {


        /**
         * Require Once qua đườg dẫn tương đối tình từ thư mục chứa App.php
         * Ví dụ import file này:
         *      Func::Import("Core/Function.class")
         *      hoặc
         *      Func::Import("Core/Function.class.php")
         *      
         *
         * @param string $path
         * @return void
         */
        public static function Import(string $path){
            $path = preg_replace("/\.php$/", "", $path);
            require_once $path.".php";
        }


        /**
         * Include Once nếu file tồn tại
         *
         * @param string $path
         * @return bool
         */
        public static function include_once_exists($path){
            if(!file_exists($path)) 
                return false;
            require_once $path; 
            return true;
        }


        /**
         * Chuyển hướng đến path
         *
         * @param string $path
         * @return void
         */
        public static function Redirect($path){
            header('Location: '.$path);
        }


        
        /**
         * Import & thực hiện Action controller qua tên tương ứng
         *
         * @param string $controller
         * @param string $action
         * @return bool
         */
        public static function RunController($controller, $action = "Index", $params = null)
        {
                $action = $action == "" ? "Index" : $action;
                try {
                    $controller = ucwords($controller);
                    $action = ucwords($action);

                    #include [ControllerName].controller.php
                    if (!Func::include_once_exists("Controller/$controller.controller.php"))
                        return false;

                    # new [NameController]Controller()
                    $controller = $controller . 'Controller';
                    $controller = new $controller;
                    if(isset($params))
                        $controller->$action($params);
                    else
                        $controller->$action();

                    return true;
                } catch (\Exception $e) {
                    echo '<pre>' . $e . '</pre>';
                } catch (\Throwable $e) {
                    echo '<pre>' . $e . '</pre>';
                }
                return false;
        }
    }


?>

