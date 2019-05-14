<div id="body-home" class="pd-top-80">
    <!--container chuyên mục-->
    <div class="cm-container">

        <div class="cm-path" id="cmpath">
            <span>
                <a href="{{YUH_URI_ROOT}}/">Trang chủ</a>
            </span>
            <span>
                <a href="{{YUH_URI_ROOT}}/categories">Chuyên Mục</a>
            </span>

                @include "Func.php";
                {{GetCategoriesPath(@Data:categorie_id, @Data:page_menu)}}

        </div>

        <div class="cm-title" id="cmcmp">
            <span>Chuyên Mục</span>
        </div>

        <div class="cm-bor">
                <!--Menu chuyên mục-->
                @include "MenuCategories.php";
                <!--Danh sách sản phẩm-->
                <!--include dirname(__FILE__)."/ListProduct/ListProduct.php"-->
        </div>
    </div>
</div> 