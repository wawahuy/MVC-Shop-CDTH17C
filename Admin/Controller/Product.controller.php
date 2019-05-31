<?php
Func::Import("Model/Product.Model.php");

    class ProductController extends BaseController{
        public function Index(){
            $product = new Product();
            $info = $product -> getProduct();
            $code_data = "";
            foreach($info as $order_data){
                $code_data.= View::general_code(dirname(__FILE__).'/../View/Products/product_data.php',[
                    'name'=>$order_data['product_name'],
                    'remai'=>$order_data['product_num_remai'],
                    'price'=>$order_data['product_price'],
                    'sold'=>$order_data['product_num_sold']
                ]);

            }

            View::bind_data('product_list',$code_data);
            parent::renderPage(
            "SShop - Trang chủ",
            dirname(__FILE__).'/../View/Home/Layout.php',
            dirname(__FILE__).'/../View/Products/product.php'
             
            );
        }
    }
?>