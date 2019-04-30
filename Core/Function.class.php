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
         * Include Once controller
         *
         * @param string $controller
         * @return bool
         */
        public static function ImportController($controller){
            $controller = ucwords($controller);
            return Func::include_once_exists('Controller/'.$controller.'.controller.php');
        }


        /**
         * Include Once model
         *
         * @param string $model
         * @return bool
         */
        public static function ImportModel($model){
            $model = ucwords($model);
            require_once 'Model/'.$model.'Model.class.php';
        }


        /**
         * Inlcude Once Entity
         *
         * @param string $entity
         * @return bool
         */
        public static function ImportEntity($entity){
            $entity = ucwords($entity);
            require_once 'Model/Entity/'.$entity.'Entity.class.php';
        }


        /**
         * Tạo model qua tên
         * Không cần Import file
         *
         * @param string $model
         * @return bool
         */
        public static function CreateModel($model){
            Func::ImportModel($model);
            $model = ucwords($model)."Model";
            return new $model;
        }


        /**
         * Tạo entity qua tên
         * Không cần Import file
         *
         * @param string $entity
         * @return bool
         */
        public static function CreateEntity($entity){
            Func::ImportEntity($entity);
            $model = ucwords($entity)."Entity";
            return new $entity;
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
                    if (!Func::ImportController($controller))
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

