<ul class="list-group">

    <?php
        $DataMenu = [
            [
                "Thông tin tài khoản",
                YUH_URI_ROOT."/profile/user"
            ],
            [
                "Đổi mật khẩu",
                YUH_URI_ROOT."/profile/changepassword"
            ],
            [
                "Danh sách liên hệ",
                YUH_URI_ROOT."/profile/contact"
            ],
            [
                "Đơn hàng",
                YUH_URI_ROOT."/profile/order"
            ]
        ];
    ?>

    <li class="list-group-item active"><b>Quản lý người dùng</b></li>

    @foreach $DataMenu as $value
        <li class="list-group-item {{$value[0] == @Data:page_title ? 'disabled' : ''}}">
            {{ $value[0] == @Data:page_title ? "" : '<a href="'.$value[1].'">'}}
                {{$value[0]}}
            {{ $value[0] == @Data:page_title ? "" : '</a>'}}
        </li>
        @endforeach
</ul>