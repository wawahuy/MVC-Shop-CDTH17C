@call JS_Call_When_Onload('SSp.init')

<style>
    .bg-header {
        padding: 10px;
    }
</style>

<div id="body-home" class="pd-top-80">
    <!--container chuyên mục-->
    <div class="sp-container">

        <div class="sp-path" id="sppath">
            <span>
                <a href="index.php">Trang chủ</a>
            </span>
            <span>
                <a href="categories.php">Chuyên Mục</a>
            </span>

            @include "../Categories/Func.php"
            {{GetCategoriesPath(@Data:product->categoriesId, @Data:page_menu)}}

        </div>

        <!--phần nội dung chính-->
        <div class="sp-bor" id='spcon'>
            
            @include "ImgProduct.php"
            @include "DeltailProduct.php"

        </div>

        <!--phần comment-->
        <div class="bg-yeuthich" style="margin-top: 70px;">
            <div class="bg-header">
                Bình luận
            </div>
            @include "CommentProduct.php"
        </div>
        

        <!--phần sản phẩm yêu thích-->
        <div class="bg-yeuthich" style="margin-top: 70px;">
            <div class="bg-header">
                Có thể bạn sẽ thích?
            </div>
            <!--phần này update sau-->
            <div class="pd-slides-view" style="margin-top: 0;" id="hot-sale">
                <div class="btR"></div>
                <div class="btL"></div>
                <div class="pd-slides-container"></div>
            </div>
            <!--ends slide nổi bật-->
        </div>
    </div>

</div>
