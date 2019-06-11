<?php
class Product {

    public function getProduct(){
        $data = DB::connection()
            ->table('products')
            ->where('product_status = \'Hoạt Động\'')
            ->executeReader();

        return $data;
    }

    public function getProductByID($id){
        $data = DB::connection()
            ->table('products')
            ->where('product_status = \'Hoạt Động\' and product_id = ?')
            ->setParams([$id])
            ->executeReader()[0];

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


    public function update(
        $ten,
        $soluong,
        $thongtin,
        $gia,
        $giamgia,
        $sao,
        $chuyenmuc,
        $anh,
        $sanpham
    ){
        DB::connection()
            ->table("products")
            ->where("product_id = ?")
            ->setParams([$sanpham])
            ->update([
                "product_name" => $ten,
                "product_num_remai" =>$soluong,
                "product_deltail" => $thongtin,
                "product_price" => $gia,
                "product_sale" => $giamgia,
                "product_star" => $sao,
                "categorie_id" => $chuyenmuc,
                "product_image" => json_encode([$anh]),
            ]);
    }


    public function delete($id){
        return DB::connection()
                ->table("products")
                ->where("product_id = ?")
                ->setParams([$id])
                ->update([ "product_status" => "Xóa"]) > 0;
    }

}

?>