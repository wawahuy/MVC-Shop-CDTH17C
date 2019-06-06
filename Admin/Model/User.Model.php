<?php
    class User {
        public function getUsersInfo(){
            $data = DB::connection()
            ->table("members")
            ->where("member_status <> 2")
            ->executeReader();
            
            return $data;
        }

        // xóa khách hàng
        public function user_remove($id){
            return DB::connection()
                        ->table("members")
                        ->where("member_id = ?")
                        ->setParams([$id])
                        ->update([
                            "member_status" => 2
                        ]);
        }


        public function user_active($id){
            return DB::connection()
                        ->table("members")
                        ->where("member_id = ?")
                        ->setParams([$id])
                        ->update([
                            "member_status" => 0
                        ]);
        }
        

        public function user_deactive($id){
            return DB::connection()
                        ->table("members")
                        ->where("member_id = ?")
                        ->setParams([$id])
                        ->update([
                            "member_status" => 1
                        ]);
        }

    }
?>