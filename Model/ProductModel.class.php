<?php
    Func::Import("Model/Entity/ProductCardEntity.class");
    Func::Import("Model/Entity/ProductEntity.class");


    /**
     * Tập hợp các phương thức xữ lí Product Table
     * 
     * 
     */
    class ProductModel {


        /**
         * Lấy sản phẩm qua ID
         *
         * @param string $id
         * @return ProductEntity
         */
        public function getProductByID($id) {
            $query = DB::connection()
                        ->table('product')
                        ->where('id = ?')
                        ->setParams([$id]);
            
            #Nếu không tồn tại sản phẩm
            if($query->exectuteScalar() <= 0)
                return null;

            #Nếu tồn tại
            $data = $query->executeReader()[0];
            $entity = new ProductEntity();
            $entity->id = $data['id'];
            $entity->name = $data['name'];
            $entity->image = json_decode($data['image']);
            $entity->sale = $data['sale'];
            $entity->maxstar = 5;
            $entity->curstar = $data['star'];
            $entity->price = $data['price'];
            $entity->note = $data['note'];
            $entity->deltail = $data['deltail'];
            $entity->categoriesId = $data['categories_id'];
            $entity->numView = $data['view'];
            $entity->numProductCurrent = $data['num_current'];
            $entity->numProductSold = $data['num_sold'];
            $entity->jsonOption = json_decode($data['json_option']);
            
            return $entity;
        }



        /**
         * Lấy 10 sản phẩm yêu chuộng nhất
         *
         * @return array
         */
        public function GetProductCard10Popular() : array {
            #Script SQL find Top Sale
            #Tiêu chí hình thành top popular: mua nhieu nhat
            $data = DB::connection()
                        ->table('products')
                        ->select('product_id, product_image, product_sale, product_name, product_star, product_price, product_num_sold')
                        ->orderby('product_num_sold', ORDER_BY_DESC)
                        ->limit(0, 10)
                        ->executeReader();
            $arr = array();

            foreach ($data as $pr) {
                $e = new ProductCardEntity();
                $e->id = $pr['product_id'];
                $e->image = json_decode($pr['product_image'])[0];
                $e->sale = $pr['product_sale'];
                $e->name = $pr['product_name'];
                $e->curstar = $pr['product_star'];
                $e->maxstar = 5;
                $e->price = $pr['product_price'];
                $e->note = "LIKE";
                array_push($arr, $e);
            }

            return $arr;
        }



        /**
         * Lấy 10 sản phẩm giảm giá tốt nhất
         *
         * @return array
         */
        public function GetProductCard10Sale() : array {
            #Script SQL find Top Sale
            #Tiêu chí hình thành top sale: phân trăm cao => khả năng cao
            
            $data = DB::connection()
                     ->table('products')
                     ->select('product_id, product_image, product_sale, product_name, product_star, product_price, product_num_sold')
                     ->where('product_sale != 0')
                     ->orderby('product_num_sold', ORDER_BY_DESC)
                     ->limit(0, 10)
                     ->executeReader();

            $arr = array();

            foreach ($data as $pr) {
                $e = new ProductCardEntity();
                $e->id = $pr['product_id'];
                $e->image = json_decode($pr['product_image'])[0];
                $e->sale = $pr['product_sale'];
                $e->name = $pr['product_name'];
                $e->curstar = $pr['product_star'];
                $e->maxstar = 5;
                $e->price = $pr['product_price'];
                $e->note = "LIKE";
                array_push($arr, $e);
            }

            return $arr;
        }

    }
?>
