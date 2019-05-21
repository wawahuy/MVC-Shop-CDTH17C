<?php
 Func::Import("Model/BagModel.class");
 Func::Import("Model/OrderModel.class");
 Func::Import("Model/ContactModel.class");


 class BagController extends BaseController {

     public function Index(){
        $modelBag = new BagModel;
        $html_product = $modelBag->makeHTMLCart();
        $num_product = $modelBag->getNumProduct();
        $price_product = $modelBag->getPriceProduct();
        $contacts = (new ContactModel)->GetContactList(Session::GetIDLogged());

        View::bind_data("num_product", $num_product);
        View::bind_data("price_product", $price_product);
        View::bind_data("price_all", $price_product);
        View::bind_data("list_cart", $html_product);
        View::bind_data("contacts", $contacts);

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


     public function Change(){
         $id  = $_POST["product"] ?? "";
         $num = $_POST["num"] ?? "";
        
         if($id != "" && $num!=""){
            if(isset($_POST["delete"])){
                (new BagModel())->remove($id);
            }
            else if(isset($_POST["update"])){
                (new BagModel())->update($id, $num);
            }
         }

         Route::Redirect("/bag");
     }




     public function Checkout(){
        if(!Session::IsLogged()) Route::Redirect("/login");

        $id_contact = $_POST["contact"] ?? -1;

        $modelContact = new ContactModel;
        $contact = $modelContact->GetContactByID($id_contact, Session::GetIDLogged());
        if(count($contact) <= 0){
            Route::Redirect("/bag");
            return;
        }


        $modelBag = new BagModel;
        $bag = $modelBag->getDataBag() ?? [];
        if(count($bag) <= 0  && $modelBag->checkBag()){
            $modelBag->setDataBag([]);
            Route::Redirect("/bag");
            return;
        }


        #thêm giỏ hàng
        $orderModel = new OrderModel();
        if(!$orderModel->Insert(Session::GetIDLogged(), $bag, $contact["contact_address"], $contact["contact_phone"])){
            (new BagModel())->setDataBag([]);
            Javascript::InvokeSwal("Lỗi", "Đặt hàng gặp vấn đề!", "error");
            Javascript::InvokeRedirect(YUH_URI_ROOT."/bag", 1000);
        }


        parent::renderPage(
            "SShop - Giỏ hàng",
            "{$GLOBALS['VIEW_DIR']}/../View/Shared/Layout.php",
            "{$GLOBALS['VIEW_DIR']}/../View/Bag/Checkout.php"
        );
     }


 }

?>