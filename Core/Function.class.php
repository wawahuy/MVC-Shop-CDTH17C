<?php

    /**
     * Coder: Nguyễn Gia Huy
     * Bắt đầu: 01-04-2019
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
         * Gọi phương thức của class (tạo mới) rỗng
         * Ứng dụng gọi action của controller
         *      <path>[(ClassName)][->Method]
         *      path: đương dẫn tương đối bắt đầu từ App.php (chỉ chấp nhận a-zA-Z0-9 _ và .)
         *      classname: tên class mặc định "phần cuối tính từ / đến . hoặc hết"
         *      method: tên phuowg thức mặc định là Index
         *
         * @param string $str
         * @return void
         */
        public static function Call_method_of_class_empty(string $str, $params = null){
             $matches = null;
             if(!preg_match("/^(?P<path>[\d|\w\/\.\_]+)(\((?P<class>.*)\))?(->(?P<method>.*))?/", $str, $matches)){
                echo "Lối Call_method_of_class_empty";
                exit();
             }

             $path = $matches["path"];
             $class = $matches["class"] ?? preg_replace("/(.*)\(|\)(.*)/", "", $str);
             $method = $matches["method"] ?? "Index";

             Func::Import($path);
             if(isset($params))
                (new $class)->$method($params);
             else
                (new $class)->$method();
        }


        /**
         * Require Once nếu file tồn tại
         *
         * @param string $path
         * @return bool
         */
        public static function require_once_exists($path){
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


        
    }


?>

