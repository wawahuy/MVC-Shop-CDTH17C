<?php
    Func::Import("Model/ProductModel.class");
    Func::Import("Model/CommentModel.class");


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


        /////
        /////   Chưa hỗ trọ show comment thêm
        /////


        public function AddComment($params){
            #Kiểm tra đăng nhập
            if(!Session::IsLogged()){
                echo json_encode(["message" => "Bạn chưa đăng nhập!", "code" => "error"]);
            }
            else {
                $comment = $_POST["comment"] ?? "";
                $reply =  $_POST["reply"] ?? null;
                $id_product = $params["id"];

                #Kiểm tra độ dài comment
                if(strlen($comment) < 3 || strlen($comment) > 1000){
                    echo json_encode(["message" => "Vui lòng nhập comment >=3 & <=1000 kí tự!", "code" => "error"]);
                    return;
                }

                #Kiểm tra comment trên sản phẩm đúng
                $modelComment = new CommentModel();
                if((new ProductModel)->getProductByID($id_product) == null){
                    echo json_encode(["message" =>  "Sản phẩm không tồn tại!", "code" => "error"]);
                    return;
                }

                #Kiểm tra đăng comment
                if($modelComment->addComment($id_product, $comment, Session::GetIDLogged(), $reply)){
                    echo json_encode(["message" =>  "Đăng comment thành công!", "code" => "success"]);
                }
                else {
                    echo json_encode(["message" =>  "Đăng comment thất bại!", "code" => "error"]);
                }
            }
        }


        public function ViewComment($params){
            $modelComment = new CommentModel();
            $data = $modelComment->getCommentParent($params["id"], $params["start"], $params["count"]);
            $data = $modelComment->createJsonComment($data);
            echo $modelComment->makeHTMLComment($data);
        }

    }


?>

