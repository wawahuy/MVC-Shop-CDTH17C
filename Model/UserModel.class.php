<?php
    class UserModel {


        public function GetFullNameWithID($id){
            $data = DB::connection()
                        ->table('members')
                        ->select('member_fullname')
                        ->where('member_id = ?')
                        ->setParams([$id])
                        ->executeReader();

            return $data[0]['member_fullname'];
        }


        // public function GetDataWithID($id){
        //     $query = "select * from members where id=?";
        //     $data = query($query, array($id));
        //     return $data[0];
        // }

        public function GetIDWithUsername($user){
            return DB::connection()
                    ->table('members')
                    ->select('member_id')
                    ->where('member_user = ?')
                    ->setParams([$user])
                    ->executeReader()[0]['member_id'];
        }

        public function GetIDWithEmail($email){
            return DB::connection()
                    ->table('members')
                    ->select('member_id')
                    ->where('member_email = ?')
                    ->setParams([$email])
                    ->executeReader()[0]['member_id'];
        }


        public function InvalidUsername($user){
            return (DB::connection()
                    ->table('members')
                    ->where('member_user = ?')
                    ->setParams([$user])
                    ->exectuteScalar() <= 0);
        }

        public function InvalidEmail($email){
            return (DB::connection()
                    ->table('members')
                    ->where('member_email = ?')
                    ->setParams([$email])
                    ->exectuteScalar() <= 0);
        }

        public function InvalidLoginUsername($user, $pass){
            return (DB::connection()
                    ->table('members')
                    ->where('member_user = ? and member_pass = ?')
                    ->setParams([$user, md5($pass)])
                    ->exectuteScalar() <= 0);
        }

        public function InvalidLoginEmail($email, $pass){
            return (DB::connection()
                    ->table('members')
                    ->where('member_email = ? and member_pass = ?')
                    ->setParams([$email, md5($pass)])
                    ->exectuteScalar() <= 0);
        }
        
        public function CreateAccount(
            $username,
            $email,
            $password,
            $fullname,
            $phone,
            $sex,
            $birth){

                //Re - update $address, $indentity card 10-05-2019


            return DB::connection()
                ->table('members')
                ->insert([
                    "member_user"        => $username,
                    "member_email"       => $email,
                    "member_pass"        => md5($password),
                    "member_fullname"    => $fullname,
                    "member_phone"       => $phone,
                    "member_sex"         => $sex,
                    "member_birth"       => $birth
                ]);
        }

    }

?>