<?php

    class CategoriesModel {

        public function GetCategoriesNoChild(){
            $data = DB::connection()
                        ->table("categories ca1")
                        ->where("not EXISTS (SELECT * FROM categories ca2 WHERE ca2.categorie_parent = ca1.categorie_parent)")
                        ->executeReader();
            return $data;
        }

    }
?>