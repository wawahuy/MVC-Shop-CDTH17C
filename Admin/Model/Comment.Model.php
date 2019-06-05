<?php
    class Comment{
        public function getComment(){
            $data = DB::connection()
                ->table("comments")
                ->executeReader();
            return $data;
        }
        public function comment_confirmed($id_comment){
            return DB::connection()
            ->table("comments")
            ->where("comment_id = ?")
            ->setParams([$id_comment])
            ->update([
                'comment_status'=>1
            ])>0;

        }


        public function comment_remove($id_comment){
            return DB::connection()
            ->query('delete  from comments where comment_id = ?')
            ->setParams([$id_comment])
            ->executeNonQuery()>0;
        }
    }
?>