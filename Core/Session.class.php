<?php

    /**
     * Coder: Nguyễn Gia Huy
     * Bắt đầu: 01-04-2019
     * 
     * 
     * 
     */

    session_start();


    class Session {

        public static function IsAdminLogged(){
            return Session::Get("admin_id") != null;
        }

        public static function IsLogged(){
            return Session::Get("user_id") !== null;
        }
        
        public static function SetLoggedID($id){
            Session::Set("user_id", $id);
        }

        public static function SetIDAdminLogged($id){
            Session::Set("admin_id", $id);
        }

        public static function GetIDLogged(){
            return Session::Get("user_id");
        }

        public static function GetIDAdminLogged(){
            return Session::Get("admin_id");
        }

        public static function Get($name){
            return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
        }

        public static function Set($name, $value){
            $_SESSION[$name] = $value;
        }

        public static function DestroyAll(){
            session_destroy();
        }

    }

?>