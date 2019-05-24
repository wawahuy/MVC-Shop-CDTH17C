<?php
Func::Import("Model/Order.Model.php");

    class OrderController extends BaseController{
        public function Index(){
            $order = new Order();
            $info = $order -> getOrders();
            $code_data = "";
            foreach($info as $order_data){
                $code_data.= View::general_code(dirname(__FILE__).'/../View/Order/Order_data.php',[
                    'id'=>$order_data['order_id'],
                    'date'=>$order_data['order_date'],
                    'price'=>$order_data['order_price'],
                    'status'=>$order_data['order_status']
                ]);

            }

            View::bind_data('order_list',$code_data);
            parent::renderPage(
            "SShop - Trang chủ",
            dirname(__FILE__).'/../View/Home/Layout.php',
            dirname(__FILE__).'/../View/Order/Order.php'
             
            );
        }
    }
?>