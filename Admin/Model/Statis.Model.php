<?php
    class thongke{
        public function doanhsobanhang(){
            $data = DB::connection()
            ->table("products")
            ->executeReader();

            return $data;
        }
    }

?>