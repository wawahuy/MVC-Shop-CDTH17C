<style>
    .cm-path span {
        padding: 5px;
        color: #242424;
        font-weight: bold;
        font-size: 16px;
    }

    .cm-path {
        margin-top: 20px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    .center {
        text-align: center;
    }

    .cm-cn {
        margin-bottom: 50px;
    }

    .cm-cn::after, .clear {
        display: block;
        clear: both;
        content: '';
    }

    .clear {
        text-align: center;
        padding : 10px;
    }

    .pd-container {
        width: 23.5%;
    }
</style>

<div class="cm-sanpham">
    <div class="cm-c-sanpham">
        <!--page-->
        

        <!--sản phẩm-->
        <div id="cmProduct">
            <?php
                #Khi không có sản phẩm
                if(count($YUH_ENTITY_CONTENT->categoriesProduct) == 0)
                    echo "<h2 class='center'>Không tồn tại sản phẩm trong chuyên mục này!</h2>";

                #Khi Không tồn tại child, nút lá render page
                else if($YUH_ENTITY_CONTENT->exists_child){

                    $BORDER = "bottom";
                    include dirname(__FILE__)."/SelectPage.php";

                    foreach ($YUH_ENTITY_CONTENT->categoriesProduct as $categories) {
                        echo "<div class='cm-cn'>";
                        foreach ($categories->product as $DATA) {
                            include dirname(__FILE__)."/ProductCard.php";
                        }
                        echo "</div>";
                    }

                    $BORDER = "top";
                    include dirname(__FILE__)."/SelectPage.php";
                }

                #Khi tồn tại nhiều child, không render tùy chỉnh page
                else
                foreach ($YUH_ENTITY_CONTENT->categoriesProduct as $categories) {
                    echo "<h3 class='cm-path'>".GetCategoriesPath($categories->id, $YUH_ENTITY_PAGE->menu)."</h3>";
                    echo "<div class='cm-cn'>";
                    foreach ($categories->product as $DATA) {
                        include dirname(__FILE__)."/ProductCard.php";
                    }
                    echo "<h8 class='clear'>(Chon trên thanh chuyên mục con cấp thấp nhất để xem nhiêu sản phẩm)</h8>";
                    echo "</div>";

                }

            ?>
        </div>

    </div>
</div> 