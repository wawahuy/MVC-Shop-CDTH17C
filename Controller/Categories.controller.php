<?php
    define("NUM_PRODUCT_PAGE", 16);

    Func::Import("Model/CategoriesModel.class");

    class CategoriesController extends BaseController {

        public function Index(){
            $this->ViewAll();
        }


        public function ViewAll(){
            View::bind_data("categorie_id", null);
            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Categories/Categories.php');
        }


        public function View($params){

            $categorie_id = $params['id'];
            $categorieModel = new CategoriesModel();

            #Kiểm tra tồn tại của categorieID
            if(!$categorieModel->HasCategorieID($categorie_id)){
                Javascript::InvokeSwal("Lỗi", "Không tìm thấy chuyên mục yêu cầu!", "error");
                $this->ViewAll();
                return;
            }



            //$model = new CategoriesModel();

            // $entity = new Categories();
            // $entity->categoriesId = $_GET['id'];
            // $entity->exists_child = count($model->GetIDCategoriesChild($_GET['id'] )) == 0 && $_GET['id']!=null;

            // $limit_start = 0;
            // $limit_count = 8;
            // if($entity->exists_child ){
            //     $limit_count = 16;
            //     $entity->pageMax = $model->GetNumProductCategories($_GET['id']) / $limit_count;
            //     $entity->pageMax = $entity->pageMax > round($entity->pageMax) ? round($entity->pageMax) + 1 : $entity->pageMax;
            //     $entity->pageCurrent = !isset($_GET['idpage']) ? 1 : $_GET['idpage'];
            //     if($entity->pageCurrent > $entity->pageMax) $entity->pageCurrent = $entity->pageMax;
            //     if($entity->pageCurrent < 1) $entity->pageCurrent = 1;
            //     $limit_start = $limit_count * ($entity->pageCurrent-1);
            // }
            // $entity->categoriesProduct = $model->GetProductWithIDCategories($_GET['id'], $limit_start, $limit_count);

            View::bind_data("categorie_id", $categorie_id);

            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Categories/Categories.php');
        }

    }


?>

