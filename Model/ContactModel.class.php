<?php

    class ContactModel {

        public function GetContactList($id){
            return DB::connection()
                        ->table("contacts")
                        ->where("member_id = ?")
                        ->setParams([$id])
                        ->executeReader();
        }


        public function GetContactByID($id_contact, $id_member){
            return DB::connection()
                        ->table("contacts")
                        ->where("member_id = ? and contact_id = ?")
                        ->setParams([$id_member, $id_contact])
                        ->executeReader();
        }

        public function Insert($id, $phone, $address){
            return DB::connection()
                ->table('contacts')
                ->insert([
                    "member_id"        => $id,
                    "contact_phone"       => $phone,
                    "contact_address"        => $address
                ]);
        }


        public function Update($id_member, $id_contact, $phone, $address){
            return DB::connection()
                ->table('contacts')
                ->where("member_id = ? and contact_id = ?")
                ->setParams([$id_member, $id_contact])
                ->update([
                    "contact_phone"       => $phone,
                    "contact_address"        => $address
                ]);
        }



        public function Delete($id_member, $id_contact ){
            return DB::connection()
                ->query("delete from contacts where contact_id=? and member_id=?", [$id_contact, $id_member])
                ->executeNonQuery() > 0;
        }

    }

?>