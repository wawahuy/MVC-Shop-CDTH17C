<?php

    // Will Update 10/05/2019
    
    require_once dirname(__FILE__)."/../Model/Entity/CategoriesEntity.class.php";
    require_once dirname(__FILE__)."/../Model/Entity/ProductCardEntity.class.php";

    class CategoriesModel extends Database {

        public function GetNumProductCategories($id){
            $query = "select count(id) num from product where categories_id = ?";
            $data = parent::query($query, array($id));
            return $data[0]['num'];
        }

        public function GetIDCategoriesChild($id){
            $query = "select id_child from categories_child where id_parent = ?";
            $data = parent::query($query, array($id));
            $arr = array();
            foreach ($data as $value) array_push($arr, $value['id_child']);
            return $arr;
        }

        public function GetIDCategoriesAllChild($id){
            $arr = array($id);
            $arr_root = $this->GetIDCategoriesChild($id);
            foreach ($arr_root as $value) {
                array_push($arr, $value);
                $arr = array_merge($arr, $this->GetIDCategoriesChild($value));
            }
            return $arr;
        }

        public function GetIDCategoriesAll(){
            $query = "select id from categories";
            $data = parent::query($query);
            $arr = array();
            foreach ($data as $value) array_push($arr, $value['id']);
            return $arr;
        }

        public function GetProductWithIDCategories($id, $limit_start = 0, $limit_count = 8){
            $list_id = array();

            if($id == null){
                $list_id = $this->GetIDCategoriesAll();
            } else {
                $list_id = $this->GetIDCategoriesAllChild($id);
            }

            $categoriesProducts = array();

            foreach($list_id as $idc){
                $categoriesProduct = new CategoriesProduct();
                $categoriesProduct->id = $idc;
                $categoriesProduct->product = array();

                $query = " select id, image, sale, name, star, price, note".
                        " from product".
                        " where categories_id = ".$idc.
                        " order by id desc".
                        " limit {$limit_start}, {$limit_count}";
                $data = parent::query($query);

                foreach ($data as $pr) {
                    $e = new ProductCard();
                    $e->id = $pr['id'];
                    $e->image = json_decode($pr['image'])[0];
                    $e->sale = $pr['sale'];
                    $e->note = $pr['note'];
                    $e->name = $pr['name'];
                    $e->curstar = $pr['star'];
                    $e->maxstar = 5;
                    $e->price = $pr['price'];
                    array_push($categoriesProduct->product, $e);
                }

                if(count( $categoriesProduct->product) > 0)
                    array_push($categoriesProducts, $categoriesProduct);
            }

            return $categoriesProducts;
        }

    }
?>