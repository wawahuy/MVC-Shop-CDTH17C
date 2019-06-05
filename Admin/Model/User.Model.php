<?php
    class User {
        public function getUsersInfo(){
            $data = DB::connection()
            ->table("members")
            ->executeReader();
            
            return $data;
        }

        // xóa khách hàng
        public function user_remove($id){
            return DB::connection()
            ->query('delete  from members where member_id = ?')
            ->setParams([$id])
            ->executeNonQuery()>0;
        }
        
    }
?>