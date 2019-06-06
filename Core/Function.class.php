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


        /**
         * Kiểm tra kiểu dữ liệu file
         * Copy https://stackoverflow.com/a/44107941/9946233
         *
         * @param string $file
         * @return void
         */
        public static function GetMime($file) {
            if (function_exists("finfo_file")) {
              $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
              $mime = finfo_file($finfo, $file);
              finfo_close($finfo);
              return $mime;
            } else if (function_exists("mime_content_type")) {
              return mime_content_type($file);
            } else if (!stristr(ini_get("disable_functions"), "shell_exec")) {
              // http://stackoverflow.com/a/134930/1593459
              $file = escapeshellarg($file);
              $mime = shell_exec("file -bi " . $file);
              return $mime;
            } else {
              return false;
            }
          }


        public static function UploadImage($files){
          $file_name = $files['name'];
          $file_exte = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
          $file_size = $files["size"];
          $file_type = Func::GetMime($files["tmp_name"]);

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


          if (move_uploaded_file($files["tmp_name"], dirname(__FILE__)."/..".$target_file_upload)) {
              return $target_file_upload;
          } else {
              return "";
          }
        }
    }


?>

