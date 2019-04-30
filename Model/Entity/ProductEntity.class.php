<?php

    class ProductEntity
    {

        #ID [Number]
        public $id;

        #Image product [Array]
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

        #deltail product
        public $deltail;

        #categories id
        public $categoriesId;

        #num view
        public $numView;

        #num product in store current
        public $numProductCurrent;

        #num product sold
        public $numProductSold;

        #DATA Json option
        public $jsonOption;
    }

?>
 