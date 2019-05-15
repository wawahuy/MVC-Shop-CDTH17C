<?php
    define("NUM_PRODUCT_PAGE", 16);

    Func::Import("Model/CategoriesModel.class");
    Func::Import("Model/ProductModel.class");

    class CategoriesController extends BaseController {

        public function Index(){
            $this->View(null);
        }


        public function View($params){

            #Bind data page to view
            parent::bindPage();

            #route value
            $categorie_id = $params['id'] ?? null;
            $categorie_page = $params['page'] ?? 1;

            #get value
            $sort_data = $_GET['sort'] ?? "new";
            $search_data = $_GET['search'] ?? "";

            #model
            $categorieModel = new CategoriesModel();

            #Kiểm tra tồn tại của categorieID
            if($categorie_id!=null && !$categorieModel->HasCategorieID($categorie_id) ){
                Javascript::InvokeSwal("Lỗi", "Không tìm thấy chuyên mục yêu cầu!", "error");
                $categorie_id = null;
            } 

            #Code danh sách sản phẩm
            $categories_product_code = "";

            //Khi là chuyên mục cuối
            if($categorie_id != null && $categorieModel->IsCategoriesLast($categorie_id)){
                #Khi không có sản phẩm
                if($categorieModel->GetNumProductCategories($categorie_id) == 0){
                    $categories_product_code = "<center><h1>Không có sản phẩm!</h1></center>";
                }
                else {
                    $categories_product_code.= $this->generalHTMLCodeProductInCategories($categorie_id, $categorie_page, $sort_data, $search_data);
                }
            } 
            //Khi là chuyên mục có chuyên mục con
            else {
                $categorie_tree = $categorieModel->GetAllCategoriesChildByIDParent($categorie_id);
                foreach($categorie_tree as $ct){
                    $categories_product_code .= $this->generalHTMLCodeProductInCategories($ct, 1, $sort_data, $search_data, 8);
                }
            }

            
            #bind
            View::bind_data("categorie_id", $categorie_id);
            View::bind_data("categorie_name", $categorie_id == null ? "Tấc cả" : $categorieModel->GetName($categorie_id));
            View::bind_data("sort_data", $sort_data);
            View::bind_data("search_data", $search_data);
            View::bind_data("categories_product", $categories_product_code);
            
            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Categories/Categories.php');
        }



        private function generalHTMLCodeProductInCategories($id_categorie, $page, $sort, $search, $num_prod_page = NUM_PRODUCT_PAGE){
            $modelProduct = new ProductModel;
            $modelCategorie = new CategoriesModel;
            $num_product = $modelCategorie->GetNumProductCategories($id_categorie);
            $max_page = round($num_product/NUM_PRODUCT_PAGE);
            $page = $page < 0 ? 0 : $page > $max_page ? $max_page : $page;
            $start = $page*NUM_PRODUCT_PAGE;
            $products = $modelProduct->GetProductByCategorieID($id_categorie, $start, $num_prod_page, $sort, $search);

            #Không có sản phẩm không render chuyên mục đó
            if(count($products) == 0) return "";

            return View::general_code($GLOBALS['VIEW_DIR']."/Categories/ListProduct/CategoriesChild.php", [
                "categorie_id" => $id_categorie,
                "products" => $products,
                "max_page" => $max_page,
                "current_page" => $page
            ]);
        }

    }


?>

