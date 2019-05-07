<?php
    /* Từ các categories trong csdl chuyển nó thành Json và lưu vào CSDL
     * `Config`.`name` = 'catagories'
     * 
     */
     

    include_once dirname(__FILE__)."/../../Core/Database.class.php";

    #push child to parent categories
    function PushArrCategories(&$categories, $sqldata){
        foreach ($sqldata as $child) {
            $arr = array(
                "categorie_id"      => $child["categorie_id"],
                "categorie_name"    => $child["categorie_name"],
                "categorie_deltail" => $child["categorie_deltail"],
                "categorie_image"   => $child["categorie_image"]
            );
            array_push($categories, $arr);
        }
    }


    #create child categories
    function CreateJsonChildCategories(&$categories){
        foreach($categories as $id => $root){
            $data = DB::connection()
                        ->table("categories")
                        ->where("categorie_parent = ?")
                        ->setParams([$categories[$id]["categorie_id"]])
                        ->executeReader();

            if (count($data) > 0){
                $newcategories = &$categories[$id]["child"];
                $newcategories = array();
                PushArrCategories($newcategories, $data);
                CreateJsonChildCategories($newcategories);
            }
        }
    }


    #test create `config` table mysql with `categories` and `categories_child`
    function CreateJsonCategories(){

        #categories
        $categories = array();

        #root categories
        $data = DB::connection()
                    ->table("categories")
                    ->where("categorie_parent is null")
                    ->executeReader();
        PushArrCategories($categories, $data);


        #child categories
        CreateJsonChildCategories($categories);

        #Update `config`
        if(DB::connection()
                ->table("config")
                ->where("config_name = 'categories'")
                ->exectuteScalar() > 0){
            DB::connection()
                ->table("config")
                ->where("`config_name` = 'categories'")
                ->update([
                    "config_data" => json_encode($categories)
                ]);
        } else {
            DB::connection()->table("config")->insert([
                "config_name" => "categories",
                "config_data" => json_encode($categories)
            ]);
        }

        return $categories;
    }

    echo json_encode(CreateJsonCategories());

?>