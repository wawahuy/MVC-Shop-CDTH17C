@call JS_Call_When_Onload("Home.init")

<style>
    .pd-slides-view > span {
        display: inline-block;
        position: absolute;
        top: 50%;
        left: 50%;        
        transform: translate(-50%, -50%);
    }
</style>


<div id="body-home" class="body-home-fixed" style="display: none;">
    <img src="{{YUH_URI_ROOT}}/Resource/img/home-banner.jpg" style="width: 100%" />

    <div class="ho-top10">

        <div class="ho-header  hidden-scroll hidden-scrollefScroll1">
            <span>TOP 10 NỔI BẬT</span>
        </div>

        <div class="pd-slides-view  hidden-scroll hidden-scrollefScroll1" id="hot-product">
            
                @if count(@Data:home_top_popular) == 0 
                    <span>Không có sản phẩm!</span>

                @else

                <div class="btR"></div>
                <div class="btL"></div>

                <div class="pd-slides-container">
           
                    @foreach @Data:home_top_popular as $DATA
                        @include "../Categories/ListProduct/ProductCard.php"
                        @endforeach

                </div>
                @endif
        </div>
        <!--ends slide nổi bật-->
    </div>


    <div class="ho-sale" style="margin-top: 100px">

        <div class="ho-header  hidden-scroll hidden-scrollefScroll1">
            <span>TOP 10 Khuyến Mại</span>
        </div>

        <!--phần này update sau-->
        <div class="pd-slides-view hidden-scroll hidden-scrollefScroll1" id="hot-sale">
                @if count(@Data:home_top_sale) == 0 
                    <span>Không có sản phẩm!</span>

                @else
                <div class="btR"></div>
                <div class="btL"></div>

                <div class="pd-slides-container">
           
                    @foreach @Data:home_top_sale as $DATA
                        @include "../Categories/ListProduct/ProductCard.php"
                        @endforeach

                </div>
                @endif
        </div>
        <!--ends slide nổi bật-->
    </div>


    <div class="ho-video">
        <div class="ho-video-bg hidden-scroll hidden-scrollefScroll1"></div>
        <div class="ho-video-header">
            <div class="hidden-scroll hidden-scrollefScroll3" style="font-size: 20px;">PHONG CÁCH THỜI TRANG</div>
            <div class="hidden-scroll hidden-scrollefScroll2">SỰ ĐƠN GIẢN KHÁC BIỆT</div>
        </div>
        <video loop autoplay muted
            style="height: auto; min-width: 100%; min-height: 100%; object-fit:contain; margin-top: -200px;">
            <source type="video/mp4" src="{{URI_ROOT}}/Resource/video/home_session.mp4">
            <source type="video/webm" src="{{URI_ROOT}}/Resource/video/home_session.webm">
        </video>

    </div>

    <!--chuyên mục-->
    <div class="cm-main" style="margin-top: 0px;">
            @include "CategoriesCard/CategoriesCard.php"
    </div>

    <!--phần signup-->
    <div class="sign-footer">
        <a href="{{URI_ROOT}}/register"><img src="{{URI_ROOT}}/Resource/img/bg_home_footer.jpg"></a>
        <div class="sign-deltail">
            <div class="ho-header" style="font-size: 25px;">ĐĂNG KÍ VỚI SSHOP</div>
            <div class="dl1">Hãy trở thành người đầu tiên nhận được những ưu đãi đến từ SShop.</div>
            <div class="dl2"><a href="{{URI_ROOT}}/register">ĐĂNG KÍ</a></div>
        </div>
    </div>