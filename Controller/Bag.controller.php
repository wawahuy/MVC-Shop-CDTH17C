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


     /**
      * Thêm sản phẩm vào giỏ hàng (POST)
      *
      * @return void
      */
     public function Add(){
        $uri_refer = preg_replace('/\?(.*)$/', '', Route::getReferer());

        #Kiểm tra hợp lệ dữ liệu
        try {
            $id_product = $_POST['id_product'];
            $num_product = $_POST['soluong'];
            $option_product = json_encode($_POST['option']);

        } catch (Exception $e){
            Func::Redirect($uri_refer."?mess=error");
        }

        #Kiểm tra thêm dữ liệu
        if(!(new BagModel())->add($id_product, $num_product, $option_product)){
            Func::Redirect($uri_refer."?mess=error");
            return;
            //test
        }

        Func::Redirect($uri_refer."?mess=success");
     }


 }

?>