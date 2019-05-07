
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
        public function addComment($id_product, $comment, $id_member){
            return DB::connection()
                        ->table("comments")
                        ->insert([
                            "product_id"        => $id_product,
                            "comment_content"   => $comment,
                            "member_id"         => $id_member
                        ]);
        }


        public function getCommentParent($id_product, $start, $num){
            
            if(!is_numeric($start) || !is_numeric($num)){
                return false;
            }

            $start = round($start);
            $end = round($num);

            if($start < 0 || $num < 1){
                return false;
            }

            return DB::connection()
                        ->query("select co.comment_id, co.comment_parent, co.comment_content, co.comment_date, me.member_user, me.member_avatar from members me, comments co where me.member_id = co.member_id and co.product_id = ? and co.comment_parent is null limit $start, $num")
                        ->setParams([$id_product])
                        ->executeReader();
        }



        public function createJsonComment($data){
        }

        public function createJsonCommentChild($data, $parent){


        }

    }

?>