<?php
 Func::Import("Model/BagModel.class");


 class BagController extends BaseController {

     public function Index(){
        $modelBag = new BagModel;
        $html_product = $modelBag->makeHTMLCart();
        $num_product = $modelBag->getNumProduct();
        $price_product = $modelBag->getPriceProduct();
        $price_vc = 0;

        View::bind_data("num_product", $num_product);
        View::bind_data("price_product", $price_product);
        View::bind_data("price_vc", $price_vc);
        View::bind_data("price_all", $price_product + $price_vc);
        View::bind_data("list_cart", $html_product);
        View::bind_data("contact_addr", "UPDATE");
        View::bind_data("contact_phone", "UPDATE");

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
            $option_product = json_encode($_POST['option'] ?? "");

        } catch (Exception $e){
            Func::Redirect($uri_refer."?mess=error");
        }

        #Kiểm tra thêm dữ liệu
        if(!(new BagModel())->add($id_product, $num_product, $option_product)){
            Func::Redirect($uri_refer."?mess=error");
            return;
        }

        Func::Redirect($uri_refer."?mess=success");
     }


 }

?>