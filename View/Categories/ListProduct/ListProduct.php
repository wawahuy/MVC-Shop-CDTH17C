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
        @include "../Search.php"

        <!--sản phẩm-->
        <div id="cmProduct">
            
        </div>

        @include "SelectPage.php"
    </div>
</div> 