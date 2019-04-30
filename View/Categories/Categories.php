<div id="body-home" class="pd-top-80">
    <!--container chuyên mục-->
    <div class="cm-container">

        <div class="cm-path" id="cmpath">
            <span>
                <a href="index.php">Trang chủ</a>
            </span>
            <span>
                <a href="categories.php">Chuyên Mục</a>
            </span>

            <?php
                require dirname(__FILE__)."/Func.php";

                #Tạo phân cấp chuyên mục đến sản phẩm thông qua $caterogies cua entity page
                #EX: / Riêng Nữ/ Áo/ Áo Thun
                echo GetCategoriesPath($YUH_ENTITY_CONTENT->categoriesId, $YUH_ENTITY_PAGE->menu);
            ?>

        </div>

        <div class="cm-title" id="cmcmp">
            <span>Chuyên Mục</span>
        </div>

        <div class="cm-bor">
            <?php
                #Menu chuyên mục
                include dirname(__FILE__)."/MenuCategories.php";
                #Danh sách sản phẩm
                include dirname(__FILE__)."/ListProduct/ListProduct.php";
            ?>
        </div>
    </div>
</div> 