<?php
    Func::Import("Model/Order.Model.php");

    class OrderController extends BaseController{
        public function Index(){
            $sort = $_GET['sort'] ?? 'all';
            $start = $_GET['start'] ?? '';
            $end = $_GET['end'] ?? '';

            $order = new Order();
            $info = $order -> getOrders($sort, $start, $end);
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
            View::bind_data('sort', $sort);
            View::bind_data('start', $start);
            View::bind_data('end', $end);
            parent::renderPage(
            "SShop - Trang chủ",
            dirname(__FILE__).'/../View/Home/Layout.php',
            dirname(__FILE__).'/../View/Order/Order.php'
             
            );
        }


        public function updateStatus($params){
            $model = new Order();
            $status_current = $model->getStatusOrderByID($params['id']);
            if($status_current != ORDER_CANCEL)
            {
                switch($_GET['action'] ?? ''){
                    case 'cancel':
                        if($status_current!=ORDER_COMPLETE)
                            $model->updateStatusOrder($params['id'], ORDER_CANCEL);
                            Javascript::InvokeSwal("Hủy thành công!", "", "success");
                        break;

                    case 'confirm':
                        if($status_current==ORDER_WAIT)
                            $model->updateStatusOrder($params['id'], ORDER_CONFIRM);
                            Javascript::InvokeSwal("Đã duyệt!", "", "success");
                        break;

                    case 'complete':
                        if($status_current==ORDER_CONFIRM)
                            $model->updateStatusOrder($params['id'], ORDER_COMPLETE);
                            Javascript::InvokeSwal("Hóa đơn hoàn thành!", "", "success");
                        break;
                }
            }
            $this->Index();
        }


    }
?>