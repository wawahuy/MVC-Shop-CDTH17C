<?php
class Product {

    public function getProduct(){
        $data = DB::connection()
            ->table('products')
            ->executeReader();

        return $data;
    }
}

?>