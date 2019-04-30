<?php

    class ConfigModel {



        public function getSlides(){
            try {
                $data = DB::connection()
                            ->table('config')
                            ->select('data')
                            ->where("name = 'slides'")
                            ->executeReader()[0]['data'];

                return json_decode($data);
            } catch (Exception $e) {
                return array("Resource/img/bn1.jpg", "Resource/img/bn2.jpg");
            }
        }


        /* Lấy cấu trúc Json của NavBar trên header
         *
         */
        public function getsJsonMenu(){
            $data = DB::connection()
                        ->table("config")
                        ->select("data")
                        ->where("name = 'categories'")
                        ->executeReader()[0]['data'];

            return json_decode($data);
        }

    }


?>