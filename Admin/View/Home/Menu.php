<ul class="list-group">

    <?php
        $DataMenu = [
            [
                 
                "Thống kê ",
                YUH_URI_ROOT."/statistical"
            ],
            [
                 
                "Quản lý người dùng",
                YUH_URI_ROOT."/user_management"
            ],
            [
                 
                "Quản lý đơn hàng",
                YUH_URI_ROOT."/order_management"
            ],
            [
                
                "Quản lý sản phẩm",
                YUH_URI_ROOT."/product_management"
            ],
            [
                
                "Quản lý bình luận",
                YUH_URI_ROOT."/comment_management"
            ]
        ];
    ?>

    <!--<li class="list-group-item active"><b>Quản lý người dùng</b></li>-->
        
    @foreach $DataMenu as $value
        <li class="list-group-item {{$value[0] == @Data:page_title ? 'disabled' : ''}}">
            {{ $value[0] == @Data:page_title ? "" : '<a href="'.$value[1].'">'}}
                {{$value[0]}}
            {{ $value[0] == @Data:page_title ? "" : '</a>'}}
        </li>
        @endforeach
</ul>