<?php

    //require_once dirname(__FILE__)."/../Model/Entity/CategoriesEntity.class.php";
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
         * Lấy tên chuyên mục
         *
         * @param [type] $id
         * @return string
         */
        public function GetName($id) : string {
            return DB::connection()
                        ->table("categories")
                        ->where("categorie_id = ?")
                        ->select("categorie_name")
                        ->setParams([$id])
                        ->executeReader()[0]['categorie_name'];
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
        

    }
?>