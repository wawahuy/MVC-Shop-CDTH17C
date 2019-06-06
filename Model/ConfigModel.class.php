<?php

    class ConfigModel {



        public function getSlides(){
            try {
                $data = DB::connection()
                            ->table('config')
                            ->select('config_data')
                            ->where("config_name = 'slides'")
                            ->executeReader();

                if(count($data) > 0)
                    return json_decode($data[0]['config_data']);
            } catch (Throwable $t) {
            } catch (Exception $e) {
            }
            return array("Resource/upload/bn2.jpg", "Resource/upload/bn5.jpg");

        }


        /* Lấy cấu trúc Json của NavBar trên header
         *
         */
        public function getsJsonMenu(){
            $data = DB::connection()
                        ->table("config")
                        ->select("config_data")
                        ->where("config_name = 'categories'")
                        ->executeReader()[0]['config_data'];

            return json_decode($data);
        }


        public function counterPageView(){
            $data = DB::connection()
                        ->table("config")
                        ->select("config_data")
                        ->where("config_name = 'view'")
                        ->executeReader()[0]['config_data'];
            
            $newview = (int)$data + 1;
            
            DB::connection()
                        ->table("config")
                        ->where("config_name = 'view'")
                        ->update([
                            "config_data" => $newview
                        ]);

            return $newview;
        }

    }


?>