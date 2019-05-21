
<?php
    Func::Import("Model/ProductModel.class");

    class OrderModel {

        private function CreateOrder($id_member, $address, $phone){
            DB::connection()
                ->table("orders")
                ->insert([
                    "order_status" => "Chờ xữ lí",
                    "contact_address" => $address,
                    "contact_phone" => $phone,
                    "member_id" => $id_member
                ]);

            return DB::connection()
                    ->table("orders")
                    ->select("order_id")
                    ->orderby("order_id", ORDER_BY_DESC)
                    ->limit(0, 1)
                    ->where("member_id = ?")
                    ->setParams([$id_member])
                    ->executeReader()[0]['order_id'];

        }

        private function AddProduct($id_order, $id_product, $price, $num){
            DB::connection()
                ->table("order_elements")
                ->insert([
                    "order_id" => $id_order,
                    "product_id" => $id_product,
                    "order_ele_price" => $price,
                    "order_ele_num" => $num,
                    "order_ele_allprice" => $num*$price,
                    "order_ele_options" => ""
                ]);

        }

        public function Insert($id_member, $bag, $address, $phone){
            $id_order = $this->CreateOrder($id_member, $address, $phone);

            $allprice = 0;
            foreach ($bag as $ele) {
                $modelProd = new ProductModel;
                $profd = $modelProd->getProductByID($ele->id);
                $price = ($profd->price * (100-($profd->sale ?? 0))/100.0);
                $allprice += $price*$ele->num;

                $this->AddProduct($id_order, $profd->id, $price, $ele->num);
                $modelProd->Sold($ele->id, $ele->num);
            }


            return true;
        }


    }


?>