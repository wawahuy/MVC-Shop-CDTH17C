<?php
    Func::Import("Model/Comment.Model.php");

    class CommentController extends BaseController{
        public function Index(){
            if(!Session::IsAdminLogged()){
                Route::Redirect("/login");
                return;
            }

            $comment = new Comment();
            $info = $comment -> getComment();
            $code_data ="";
            foreach ($info as $comment_row){
                $code_data.=View::general_code(dirname(__FILE__).'/../View/Comment/Comment_data.php',[
                    'id'=>$comment_row['comment_id'],
                    'noidung'=>$comment_row['comment_content'],
                    'thoigian'=>$comment_row['comment_date'],
                    'sanpham'=>$comment_row['product_id'],
                    'trangthai'=>$comment_row['comment_status']
                ]);
            } 
            View::bind_data('comment_list',$code_data);
            parent::renderPage(
                "SShop - Trang chủ",
                dirname(__FILE__).'/../View/Home/Layout.php',
                dirname(__FILE__).'/../View/Comment/Comment.php'
            );       
        } 
        
        
        public function comment_confirmed($param){
            if(!Session::IsAdminLogged()){
                Route::Redirect("/login");
                return;
            }

            $comment = new Comment();
            if( $comment -> comment_confirmed($param['id']))
                Javascript::InvokeSwal('Duyệt thành công', '','success');
            $this -> Index();
        }
        
        public function comment_remove($param){
            if(!Session::IsAdminLogged()){
                Route::Redirect("/login");
                return;
            }
            
            $comment = new Comment();
            if( $comment -> comment_remove($param['id']))
                Javascript::InvokeSwal('Xóa thành công', '','success');
            $this -> Index();
        }
    }
?>