
<?php

    class CommentModel {

        /**
         * Kiểm tra có commnent trog sản phẩm
         *
         * @param int $id_comment
         * @param int $id_product
         * @return boolean
         */
        public function hasComment($id_comment, $id_product) : bool {
            return DB::connection()
                        ->table("comments")
                        ->where("comment_id = ? && product_id = ?")
                        ->setParams([$id_comment, $id_product])
                        ->exectuteScalar() > 0;
        }


        /**
         * Thêm comment sản phẩm
         *
         * @param int $id_product
         * @param string $comment
         * @param int $id_member
         * @return void
         */
        public function addComment($id_product, $comment, $id_member, $id_reply = null){
            #Kiểm tra trả lời comment
            if(isset($id_reply) && $id_reply != null){
                    if($this->hasComment($id_reply, $id_product)){
                        return DB::connection()
                                    ->table("comments")
                                    ->insert([
                                        "product_id"        => $id_product,
                                        "comment_content"   => $comment,
                                        "member_id"         => $id_member,
                                        "comment_parent"     => $id_reply
                                    ]);
                    }
                    return false;
            }

                
            return DB::connection()
                        ->table("comments")
                        ->insert([
                            "product_id"        => $id_product,
                            "comment_content"   => $comment,
                            "member_id"         => $id_member
                        ]);
        }


        public function getCommentParent($id_product, $start, $num){
            if(!DB::TestLimit($start, $num))
                return false;

            return DB::connection()
                        ->query("select me.member_id, co.comment_id, co.comment_parent, co.comment_content, co.comment_date, me.member_user, me.member_avatar from members me, comments co where me.member_id = co.member_id and co.product_id = ? and co.comment_parent is null  order by co.comment_date desc limit $start, $num")
                        ->setParams([$id_product])
                        ->executeReader();
        }


        public function getCommentChild($id_comment){
            return DB::connection()
                        ->query("select me.member_id, co.comment_id, co.comment_parent, co.comment_content, co.comment_date, me.member_user, me.member_avatar from members me, comments co where me.member_id = co.member_id and co.comment_parent = ?")
                        ->setParams([$id_comment])
                        ->executeReader();
        }


        public function createJsonComment($data, $idrep = null){
            $con_data = [];
            foreach($data as $row){
                $chid_data = [];
                $chid_data["id"]        = $row["comment_id"];
                $chid_data["content"]   = $row["comment_content"];
                $chid_data["date"]      = $row["comment_date"];
                $chid_data["user"]      = $row["member_user"];
                $chid_data["avatar"]    = $row["member_avatar"] ?? "/Resource/img/account.png";
                $chid_data["id_mem_rep"]     = $idrep ?? $row["member_id"];
                $chid_data["id_com_rep"]     = $idrep ?? $row["comment_id"];
                if($row["comment_parent"] == null){
                    $child = $this->getCommentChild($row["comment_id"], $row["comment_id"]);
                    if(count($child) > 0)
                        $chid_data["child"] = $this->createJsonComment($child, );
                }
                array_push($con_data, $chid_data);
            }
            return $con_data;
        }

        public function makeHTMLComment($datas){
            $code = "";
            foreach ($datas as $data ) {
                $code_child = "";
                if(array_key_exists("child", $data))
                    $code_child = $this->makeHTMLComment($data["child"]);
                $code .= View::general_code(dirname(__FILE__)."/../View/Product/CommentChild.php", [
                    "id"        => $data["id"],
                    "content"   => $data["content"],
                    "date"      => $data["date"],
                    "user"      => $data["user"],
                    "avatar"    => $data["avatar"],
                    "id_com_rep"     => $data["id_com_rep"],
                    "id_mem_rep"     => $data["id_mem_rep"],
                    "idlogged"  => Session::GetIDLogged(),
                    "child"     => $code_child ?? ""
                ]);
            }
            return $code;
        }

    }

?>