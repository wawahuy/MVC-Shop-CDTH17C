<?php
    Func::Import("Model/Comment.Model.php");

    class CommentController extends BaseController{
        public function Index(){
            $comment = new Comment();
            $info = $comment -> getComment();
            $code_data ="";
            foreach ($info as $comment_row){
                $code_data.=View::general_code(dirname(__FILE__).'/../View/Comment/Comment-data.php',[
                    'id'=>$comment_row['comment_id'],
                    'noidung'=>$comment_row['comment_content'],
                    'thoigian'=>$comment_row['comment_date'],
                    'sanpham'=>$comment_row['product_id']
                ]);
            } 
            View::bind_data('comment_list',$code_data);
            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Comment/Comment.php'
            );       
        }   
    }
?>