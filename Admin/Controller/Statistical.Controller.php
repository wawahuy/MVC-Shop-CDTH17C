<?php

class StatisticalController extends BaseController{
    public function Index(){
         parent::renderPage(
            "SShop - Trang chủ",
            dirname(__FILE__).'/../View/Home/Layout.php',
            dirname(__FILE__).'/../View/Statistical/Statistical.php'
        );
    }
}

?>