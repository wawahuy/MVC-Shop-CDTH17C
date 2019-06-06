<?php
class Product {

    public function getProduct(){
        $data = DB::connection()
            ->table('products')
            ->executeReader();

        return $data;
    }


    public function insert(
        $ten,
        $soluong,
        $thongtin,
        $gia,
        $giamgia,
        $sao,
        $chuyenmuc,
        $anh,
        $nhanvien
    ){
        DB::connection()
            ->table("products")
            ->insert([
                "product_name" => $ten,
                "product_num_remai" =>$soluong,
                "product_deltail" => $thongtin,
                "product_price" => $gia,
                "product_sale" => $giamgia,
                "product_star" => $sao,
                "categorie_id" => $chuyenmuc,
                "product_image" => json_encode([$anh]),
                "product_options" => json_encode([]),
                "employee_id" => $nhanvien
            ]);
    }

}

?>