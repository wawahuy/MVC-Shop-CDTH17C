<?php

    class CategoriesProductEntity {
        public $id;

        # array Produc
        public $product;
    }

    class CategoriesEntity {
        public $categoriesId;

        #array CategoriesProduct
        public $categoriesProduct;

        public $exists_child;

        public $pageCurrent;

        public $pageMax;

    }
?>