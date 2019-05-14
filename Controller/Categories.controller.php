<?php
    //Func::ImportModel("Categories");
    define("NUM_PRODUCT_PAGE", 16);

    class CategoriesController extends BaseController {

        public function Index(){
            $this->ViewAll();
        }


        public function ViewAll(){
        }


        public function View($params){

            echo "Đang chuyển đổi code sang core mới!";
            exit();

            $_GET['id'] = isset($_GET['id']) ? $_GET['id'] : null;

            $model = new CategoriesModel();

            $entity = new Categories();
            $entity->categoriesId = $_GET['id'];
            $entity->exists_child = count($model->GetIDCategoriesChild($_GET['id'] )) == 0 && $_GET['id']!=null;

            $limit_start = 0;
            $limit_count = 8;
            if($entity->exists_child ){
                $limit_count = 16;
                $entity->pageMax = $model->GetNumProductCategories($_GET['id']) / $limit_count;
                $entity->pageMax = $entity->pageMax > round($entity->pageMax) ? round($entity->pageMax) + 1 : $entity->pageMax;
                $entity->pageCurrent = !isset($_GET['idpage']) ? 1 : $_GET['idpage'];
                if($entity->pageCurrent > $entity->pageMax) $entity->pageCurrent = $entity->pageMax;
                if($entity->pageCurrent < 1) $entity->pageCurrent = 1;
                $limit_start = $limit_count * ($entity->pageCurrent-1);
            }
            $entity->categoriesProduct = $model->GetProductWithIDCategories($_GET['id'], $limit_start, $limit_count);

            #Render View
            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Categories/Categories.php',
                $entity
            );
        }

    }


?>

