<?php
    class Comment{
        public function getComment(){
            $data = DB::connection()
                ->table("comments")
                ->executeReader();
            return $data;
        }
    }
?>