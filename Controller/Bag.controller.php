<?php
 Func::ImportModel("Bag");

 class BagController extends BaseController {

     public function Index(){
        parent::renderPage(
             "SShop - Giỏ hàng",
             "{$GLOBALS['VIEW_DIR']}/../View/Shared/Layout.php",
             "{$GLOBALS['VIEW_DIR']}/../View/Bag/Bag.php"
         );
     }

     public function Add(){
         
     }


     /**
      * Lấy danh sách các sản phẩm đã đặt hàng
      *
      * @return void
      */
     private function getDataCart() {
         try {
            //return json_encode($this->decodeCookieCart(Cookie::Get("cart")));
         }
         catch(\Exception $e){
             return null;
         }
         catch(\Throwable $t){
             return null;
         }
     }

 }

?>