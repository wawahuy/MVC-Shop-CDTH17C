<?php

    require_once dirname(__FILE__)."/../Model/Entity/CategoriesEntity.class.php";
    require_once dirname(__FILE__)."/../Model/Entity/ProductCardEntity.class.php";


    class CategoriesModel {

        /**
         * Kiểm tra tồn tại chuyên mục
         *
         * @param int $id
         * @return boolean
         */
        public function HasCategorieID($id) : bool {
            return DB::connection()
                        ->table("categories")
                        ->where("categorie_id = ?")
                        ->setParams([$id])
                        ->exectuteScalar() > 0;
        }


        /**
         * Kiểm tra có phải là chuyên mục cuối cùng của nhánh không
         *
         * @return void
         */
        public function IsCategoriesLast($id){
            return DB::connection()
                        ->table("categories")
                        ->where("categorie_id = ? and not exists (select * from categories where categorie_parent = ?)")
                        ->setParams([$id, $id])
                        ->exectuteScalar() > 0; 
        }


        /**
         * Lấy số lượng sản phẩm trong chuyên mục
         *
         * @param int $id
         * @return void
         */
        public function GetNumProductCategories($id){
            return DB::connection()
                        ->table("products")
                        ->where("categorie_id = ?")
                        ->setParams([$id])
                        ->exectuteScalar();
        }

        /**
         * Lấy các chuyên mục con của chuyên mục
         *
         * @param int $id
         * @return void
         */
        public function GetIDCategoriesChild($id){
            $data = DB::connection()
                        ->table("categories")
                        ->where("categorie_parent = ?")
                        ->setParams([$id])
                        ->executeReader();

            $arr = array();
            foreach ($data as $value) array_push($arr, $value['categorie_id']);
            return $arr;
        }


        /**
         * Lấy các id chuyên mục là chuyên mục root
         *
         * @return void
         */
        public function GetIDCategoriesRoot(){
            $data = DB::connection()
                        ->table("categories")
                        ->where("categorie_parent is null")
                        ->executeReader();

            $arr = array();
            foreach ($data as $value) array_push($arr, $value['categorie_id']);
            return $arr;
        }


        /**
         * Lấy tấc cả chuyên mục xuất phát từ Lá $id
         * NULL sẽ mặc định là nhánh cao nhất
         *
         * @param int $id
         * @return void
         */
        function GetAllCategoriesChildByIDParent($id = null){
            $arr = [];
            $categories = $id != null ? $this->GetIDCategoriesChild($id) : $this->GetIDCategoriesRoot();
            foreach($categories as $cg){
                array_push($arr, $cg);
                $arr = array_merge($arr, $this->GetAllCategoriesChildByIDParent($cg));
            }
            return $arr;
        }
        


        // public function GetProductWithIDCategories($id, $limit_start = 0, $limit_count = 8){
        //     $list_id = array();

        //     if($id == null){
        //         $list_id = $this->GetIDCategoriesAll();
        //     } else {
        //         $list_id = $this->GetIDCategoriesAllChild($id);
        //     }

        //     $categoriesProducts = array();

        //     foreach($list_id as $idc){
        //         $categoriesProduct = new CategoriesProduct();
        //         $categoriesProduct->id = $idc;
        //         $categoriesProduct->product = array();

        //         $query = " select id, image, sale, name, star, price, note".
        //                 " from product".
        //                 " where categories_id = ".$idc.
        //                 " order by id desc".
        //                 " limit {$limit_start}, {$limit_count}";
        //         $data = parent::query($query);

        //         foreach ($data as $pr) {
        //             $e = new ProductCard();
        //             $e->id = $pr['id'];
        //             $e->image = json_decode($pr['image'])[0];
        //             $e->sale = $pr['sale'];
        //             $e->note = $pr['note'];
        //             $e->name = $pr['name'];
        //             $e->curstar = $pr['star'];
        //             $e->maxstar = 5;
        //             $e->price = $pr['price'];
        //             array_push($categoriesProduct->product, $e);
        //         }

        //         if(count( $categoriesProduct->product) > 0)
        //             array_push($categoriesProducts, $categoriesProduct);
        //     }

        //     return $categoriesProducts;
        // }

    }
?>