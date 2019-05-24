<?php
    class Order {
        public function getOrders(){
            $data = DB::connection()
            ->table("orders")
            ->executeReader();
            
            return $data;
        } 
    }
?>