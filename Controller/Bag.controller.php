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


     private function insertDataCart($prod){

     }


     /**
      * Lấy danh sách các sản phẩm đã đặt hàng
      *
      * @return void
      */
     private function getDataCart() {
         try {
            return json_encode($this->decodeCookieCart(Cookie::Get("cart")));
         }
         catch(\Exception $e){
             return null;
         }
         catch(\Throwable $t){
             return null;
         }
     }


     /**
      * Mã hóa cookie cart
      * Việc mã hóa chỉ nhằm giúp tương thích với cookie
      *
      * @param string $str
      * @return string
      */
     private function encodeCookieCart(string $str) : string {
        return base64_encode(utf8_encode($str));
     }


     /**
      * Giãi hóa cookie cart
      *
      * @param string $str
      * @return string
      */
     private function decodeCookieCart(string $str) : string {
        return utf8_decode(base64_decode($str));
     }
 }

?>