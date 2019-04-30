<?php


    /* Lấy Path đa cấp  của id qua data chuyên mục
     *
     */
    function GetCategoriesPath($id, $data){
        foreach ($data as $value) {
            $tag = "<span><a href='categories.php?id={$value->id}&name={$value->name}'>{$value->name}</a></span>";

            if($value->id == $id) return $tag;

            if( array_key_exists('child', $value) ){
                $tagchild = GetCategoriesPath($id, $value->child);
                if($tagchild!="") 
                    return $tag.$tagchild;
            }
        }

        return "";
    }


    
?>