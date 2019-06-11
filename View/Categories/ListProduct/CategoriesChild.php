    <div class="cm-path" style="margin: 30px 0 20px 0; border-top: 1px solid #eee; border-bottom:none; padding: 10px">
                @call require_once $GLOBALS['VIEW_DIR']."/Categories/Func.php"
                {{GetCategoriesPath(@Data:categorie_id, @Data:page_menu)}}
    </div>
    
    <!--product-->
    @foreach @Data:products as $DATA
        @include "ProductCard.php"
        @endforeach
    <div style="clear:both;" ></div>

    <!--page -->
    <nav aria-label="Page navigation" style="margin-top: 30px;">
    <ul class="pagination justify-content-end">
        <li class="page-item disabled">
        <a class="page-link" href="#">Cũ</a>
        </li>

        <?php
            $query = $_SERVER['QUERY_STRING'];
            $path = $_SERVER['REDIRECT_URL'];
            $path = preg_replace('/\/page\/[\d]+$/', '', $path).'/page/';

            for($i=1; $i<=View::$DATA['max_page']; $i++)
        ?>
            <li class="page-item"><a class="page-link" href="<?=$path.$i.'?'.$query;?>"><?=$i;?></a></li>

        <li class="page-item">
        <a class="page-link" href="#">Mới</a>
        </li>
    </ul>
    </nav>

