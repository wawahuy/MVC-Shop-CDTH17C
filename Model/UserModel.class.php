<?php
    class UserModel {


        public function GetFullNameWithID($id){
            $data = DB::connection()
                        ->table('members')
                        ->select('fullname')
                        ->where('id = ?')
                        ->setParams([$id])
                        ->executeReader();

            return $data[0]['fullname'];
        }


        // public function GetDataWithID($id){
        //     $query = "select * from members where id=?";
        //     $data = query($query, array($id));
        //     return $data[0];
        // }

        public function GetIDWithUsername($user){
            return DB::connection()
                    ->table('members')
                    ->select('id')
                    ->where('username = ?')
                    ->setParams([$user])
                    ->executeReader()[0]['id'];
        }

        public function GetIDWithEmail($email){
            return DB::connection()
                    ->table('members')
                    ->select('id')
                    ->where('email = ?')
                    ->setParams([$email])
                    ->executeReader()[0]['id'];
        }


        public function InvalidUsername($user){
            return (DB::connection()
                    ->table('members')
                    ->where('username = ?')
                    ->setParams([$user])
                    ->exectuteScalar() <= 0);
        }

        public function InvalidEmail($email){
            return (DB::connection()
                    ->table('members')
                    ->where('email = ?')
                    ->setParams([$email])
                    ->exectuteScalar() <= 0);
        }

        public function InvalidLoginUsername($user, $pass){
            return (DB::connection()
                    ->table('members')
                    ->where('username = ? and password = ?')
                    ->setParams([$user, $pass])
                    ->exectuteScalar() <= 0);
        }

        public function InvalidLoginEmail($email, $pass){
            return (DB::connection()
                    ->table('members')
                    ->where('email = ? and password = ?')
                    ->setParams([$email, $pass])
                    ->exectuteScalar() <= 0);
        }
        
        public function CreateAccount(
            $username,
            $email,
            $password,
            $fullname,
            $phone,
            $address,
            $indentity_card){


            return DB::connection()
                ->table('members')
                ->insert([
                    "username"        => $username,
                    "email"           => $email,
                    "password"        => $password,
                    "fullname"        => $fullname,
                    "phone"           => $phone,
                    "address"         => $address,
                    "indentity_card"  => $indentity_card
                ]);
        }

    }

?>