<?php
    class PageErrorController extends BaseController {

        public function Index(){
            parent::renderPage(
                "SShop - Lỗi trang không tồn tại!",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Error/PageNotFound.php'
            );
        }

    }


?>

