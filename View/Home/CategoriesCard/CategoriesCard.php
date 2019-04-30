    @call $i = 0
    @foreach @Data:page_menu as $DATA
        @require "{$GLOBALS['VIEW_DIR']}/Home/CategoriesCard/Card".($i++%2 ? 2 : 1).".php";
        @endforeach