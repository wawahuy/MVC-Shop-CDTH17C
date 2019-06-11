<?php
    define("ORDER_CANCEL", "Hủy");
    define("ORDER_WAIT", "Chờ xữ lí");
    define("ORDER_CONFIRM", "Đã xác nhận");
    define("ORDER_COMPLETE", "Đã hoàn thành");

    class Order {

        public function getStatusOrderByID($id){
            return DB::connection()->table("orders")->where("order_id = ?")->setParams([$id])->executeReader()[0]['order_status'];
        }

        public function updateStatusOrder($id, $status){
            return DB::connection()->table("orders")->where("order_id = ?")->setParams([$id])
                    ->update([
                        "order_status" => $status
                    ]);

        }

        public function getOrders($sort, $start, $end){
            $where = "";
            $params = [];
            $and = "";

            //sort
            if($sort!="all"){
                $and = " and ";
                $where = "order_status = ?";
                
                switch($sort){
                    case "wait":
                        array_push($params, 'Chờ xữ lí');
                        break;

                    case "cancel":
                        array_push($params, 'Hủy');
                        break;

                    case "confirm":
                        array_push($params, 'Đã xác nhận');
                        break;

                    case "complete":
                        array_push($params, 'Đã hoàn thành');
                        break;
                }

            }

            //start
            if($start!=""){
                $where .= $and." order_date >= ?";
                array_push($params, $start.' 00:00:00');
                $and = " and ";
            }

            if($end!=""){
                $where .= $and." order_date <= ?";
                array_push($params, $end.' 23:59:59');
            }

            $data = DB::connection()->table("orders");

            if($where != ""){
                $data->where($where)->setParams($params);
            }

            return $data->executeReader();
        } 

    }
?>