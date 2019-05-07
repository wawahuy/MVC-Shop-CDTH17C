<?php
    Func::Import("Model/ProductModel.class");


    /* Trang chí tiết thông tin của sản phẩm
     * 
     */
    class ProductController extends BaseController {

        public function Index(){
            parent::renderPage(
                "SShop - Sản phẩm - Không tồn tại!",
                dirname(__FILE__)."/../View/Shared/Layout.php",
                dirname(__FILE__)."/../View/Product/Empty.php"
            );
        }


        public function View($params){
            $this->message();

            if($params['id'] == ""){
                $this->Index();
                return;
            }

            #Model
            $model = new ProductModel();
            $entity = $model->getProductByID($params['id']);

            #Entity
            if($entity == null){
                $this->Index();
            }
            else {
                $model->increaseView($entity->id);
                View::bind_data('product', $entity);
                parent::renderPage(
                    "SShop - Sản phẩm - {$entity->name}",
                    dirname(__FILE__)."/../View/Shared/Layout.php",
                    dirname(__FILE__)."/../View/Product/Product.php"
                );
            }
        }


        private function message(){
            switch($_GET['mess'] ?? ''){
                case "success":
                    Javascript::InvokeSwal("Thêm sản phẩm thành công!", "", "success");
                    break;

                case "error":
                    Javascript::InvokeSwal("Thêm sản phẩm thất bại!", "", "error");
                    break;
            }
        }


        public function AddComment($params){
            if(!Session::IsLogged()){
                echo json_encode(["message" => "Bạn chưa đăng nhập!", "code" => "error"]);
            }
            else {
                $comment = $_POST["comment"] ?? "";
                $reply =  $_POST["reply"] ?? null;

                if(strlen($comment) < 3 || strlen($comment) > 1000){
                    echo json_encode(["message" => "Vui lòng nhập comment >=3 & <=1000 kí tự!", "code" => "error"]);
                    return;
                }

                $model = new ProductModel();
                if(!$model->addComment($params["id"], $comment, $reply)){
                    echo json_encode(["message" => "Lỗi comment!", "code" => "error"]);
                    return;
                }
                
                echo json_encode(["message" =>  "Đăng comment thành công!", "code" => "success"]);
            }
        }


        public function ViewComment($params){
            echo (new ProductModel())->getComment($params["id"], $params["start"], $params["count"]);
        }

    }


?>

