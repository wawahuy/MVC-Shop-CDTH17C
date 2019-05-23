<?php

    class User {
        public function getUsersInfo(){
            $data = DB::connection()
            ->table("members")
            ->executeReader();
            
            return $data;
        }

         
    }



?>