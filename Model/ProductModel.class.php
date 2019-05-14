<?php
    Func::Import("Model/Entity/ProductCardEntity.class");
    Func::Import("Model/Entity/ProductEntity.class");
    Func::Import("Model/CommentModel.class");


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
                        ->table('products')
                        ->where('product_id = ?')
                        ->setParams([$id]);
            
            #Nếu không tồn tại sản phẩm
            if($query->exectuteScalar() <= 0)
                return null;

            #Nếu tồn tại
            $data = $query->executeReader()[0];
            $entity = new ProductEntity();
            $entity->id = $data['product_id'];
            $entity->name = $data['product_name'];
            $entity->image = json_decode($data['product_image']);
            $entity->sale = $data['product_sale'];
            $entity->maxstar = 5;
            $entity->curstar = $data['product_star'];
            $entity->price = $data['product_price'];
            $entity->note = "";
            $entity->deltail = $data['product_deltail'];
            $entity->categoriesId = $data['categorie_id'];
            $entity->numView = $data['product_view'];
            $entity->numProductCurrent = $data['product_num_remai'];
            $entity->numProductSold = $data['product_num_sold'];
            $entity->jsonOption = json_decode($data['product_options']);
            
            return $entity;
        }


        /**
         * Tăng view sản phẩm
         *
         * @param int $id
         * @return void
         */
        public function increaseView($id){
            DB::connection()
                ->table("products")
                ->where("product_id = $id")
                ->update([
                    "product_view" => "(`product_view` + 1)"
                ]);
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


        public function GetProductByCategorieID($id_categorie, $limit_start, $limit_count){
            $data = DB::connection()
                        ->table('products')
                        ->select('product_id, product_image, product_sale, product_name, product_star, product_price, product_num_sold')
                        ->where('categorie_id = ?')
                        ->orderby('product_day', ORDER_BY_DESC)
                        ->limit($limit_start, $limit_count)
                        ->setParams([$id_categorie])
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
