<?php
    define("NUM_PRODUCT_PAGE", 16);

    Func::Import("Model/CategoriesModel.class");

    class CategoriesController extends BaseController {

        public function Index(){
            $this->View(null);
        }


        public function View($params){

            #route value
            $categorie_id = $params['id'] ?? null;

            #get value
            $sort_data = $_GET['sort'] ?? "new";
            $search_data = $_GET['search'] ?? "";

            #model
            $categorieModel = new CategoriesModel();

            #Kiểm tra tồn tại của categorieID
            if(!$categorieModel->HasCategorieID($categorie_id)){
                Javascript::InvokeSwal("Lỗi", "Không tìm thấy chuyên mục yêu cầu!", "error");
            } 


            //render 2 trg hợp
            //khi chuyên mục có ít nhất một con, => render NUM_PRODUCT_PAGE sản phẩm
            if($categorie_id != null && $categorieModel->IsCategoriesLast($categorie_id)){
                

            } 
            //khi chuyên mục không có chuyên mục con, => render NUM_PRODUCT_PAGE/2 sản phẩm của nó
            else {
                $categorie_tree = $categorieModel->GetAllCategoriesChildByIDParent($categorie_id);

            }

            
            View::bind_data("categorie_id", $categorie_id);
            View::bind_data("sort_data", $sort_data);
            View::bind_data("search_data", $search_data);
            
            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Categories/Categories.php');
        }

    }


?>

