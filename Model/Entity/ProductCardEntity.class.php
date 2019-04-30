<?php

    #Chứa thông tin những Grid Sản phẩm 
    class ProductCardEntity {
        #ID [Number]
        public $id;

        #Image product [String]
        public $image;

        #Sale of product [0->100]% [Number]
        public $sale;

        #Name product
        public $name;

        #Star average product
        public $curstar;

        #Max star. default 5
        public $maxstar = 5;

        #Price real product
        public $price;

        #Titlte right top product card "HOT", "NORMAL", "VIP",... if undefine show sale%
        public $note;
    }
?>