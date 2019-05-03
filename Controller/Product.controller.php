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
                View::bind_data('product', $entity);
                parent::renderPage(
                    "SShop - Sản phẩm - Không tồn tại!",
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

    }


?>

