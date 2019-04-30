<?php
    /**
     * Coder: Nguyễn Gia Huy
     * Bắt đầu: 01-04-2019
     * Sửa dổi cuối: --
     * 
     * 
     */



    class Cookie {

        /**
         * Kiểm tra nếu tồn tại key cookie
         *
         * @param string $name
         * @return bool
         */
        public static function Exists($name){
            return isset($_COOKIE[$name]);
        }


        /**
         * Lấy value của key (cookie)
         *
         * @param string $name
         * @return string
         */
        public static function Get($name){
            return $_COOKIE[$name] ?? null;
        }


        /**
         * Cập nhật giá trị của key
         *
         * @param string $name
         * @param string $value
         * @param integer $timeout
         * @return void
         */
        public static function Set($name, $value, $timeout = 0){
            $timeout = $timeout == 0 ? time() + (60*60*24*30) : $timeout;
            setcookie($name, $value, $timeout, "/");
        }


        /**
         * Xóa key
         *
         * @param string $name
         * @return void
         */
        public static function Del($name){
            Cookie::Set($name, "", time() - 3600);
        }

    }

?>