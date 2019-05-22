

<?php
    Func::Import("Model/OrderModel.class");
    Func::Import("Model/ProductModel.class");

    class ProfileOrderController extends BaseController {

        public function Index(){

            View::bind_data("orders", (new OrderModel)->GetListOrderByIDMember(Session::GetIDLogged()));

            parent::renderPage(
                "Đơn hàng",
                $GLOBALS['VIEW_DIR']."/Profile/Layout.php",
                $GLOBALS['VIEW_DIR']."/Profile/Order/Order.php"
            );
        }


        public function CancleOrder($params){
            $orderModel = new OrderModel;
            if(($_POST["action"] ?? "") != "Hủy" && $orderModel->ValidOrder(Session::GetIDLogged(), $params["id"]))
                 Route::Redirect("/profile/order");

            if($orderModel->CancleOrder($params['id'])){
                Javascript::InvokeSwal("Hủy thành công", "", "success");
            } else {
                Javascript::InvokeSwal("Hủy thất bại", "", "error");
            }

            $this->ViewDeltail($params);            
        }


        public function ViewDeltail($params){

            $orderModel = new OrderModel;
            $order = $orderModel->GetOrderByIDMember(Session::GetIDLogged(),$params['id']);

            if(count($order) == 0) Route::Redirect("/profile/order");
            $order = $order[0];
            View::bind_data("order_id", $order["order_id"]);
            View::bind_data("order_address", $order["contact_address"]);
            View::bind_data("order_phone", $order["contact_phone"]);
            View::bind_data("order_price", $order["order_price"]);
            View::bind_data("order_status", $order["order_status"]);

            #elements order
            $elements_order = $orderModel->GetElementOrderByIDOrder($params['id']);
            $code_element = "";
            foreach($elements_order as $element){
                $product = (new ProductModel)->getProductByID($element["product_id"]);
                $code_element .= View::general_code($GLOBALS['VIEW_DIR']."/Profile/Order/ElementOrder.php", [
                    "image" => $product->image[0],
                    "title" => $product->name,
                    "id" => $product->id,
                    "price" => $element["order_ele_price"],
                    "allprice" => $element["order_ele_allprice"],
                    "num" => $element["order_ele_num"]
                ]);
            }
            View::bind_data("order_element", $code_element);

            parent::renderPage(
                "Đơn hàng - #".$params["id"],
                $GLOBALS['VIEW_DIR']."/Profile/Layout.php",
                $GLOBALS['VIEW_DIR']."/Profile/Order/ViewDeltail.php"
            );
        }

    }

?>