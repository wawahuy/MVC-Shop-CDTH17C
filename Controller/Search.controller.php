<?php
    include_once dirname(__FILE__)."/../Model/SearchModel.class.php";
    

    class SearchController extends BaseController {

        public function process(){
            Javascript::InvokeScript("swal('Thông báo', 'Phần tìm kiếm đang được xây dựng!', 'warning')");
            Javascript::InvokeRedirect("index.php", 2000);

            parent::renderPage(
                "SShop - Tìm kiếm",
                dirname(__FILE__).'/../View/Shared/Layout.php',
                dirname(__FILE__).'/../View/Search/Search.php'
            );
        }

    }


?>

