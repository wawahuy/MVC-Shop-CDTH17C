<div id="body-home" class="pd-top-80">
    <div class="lg-container">
        <div class="lg-col-left">
            <div class="lg-header">Đăng nhập</div>
            <div>
                <form action="{{URI_ROOT}}/login/submit" method="POST" name="fLogin" onsubmit="Login.change()">
                    <div class="lg-input">
                        <input type="text" name="email" value="{{@Data:user}}" placeholder="Nhập email hoặc username" required>
                        <div></div>
                    </div>
                    <div class="lg-input">
                        <input type="password" name="pass" value="{{@Data:pass}}" placeholder="Nhập mật khẩu" minlength="6" required>
                        <div></div>
                    </div>
                    <input type="checkbox" class="lg-check" {{@Data:save ? "checked" : ""}} name="saveinfo" value="1"> Lưu giữ thông tin & trạng thái đăng nhập
                    <br>
                    <button type="submit" class="lg-bt lg-bt-log">ĐĂNG NHẬP</button>
                </form>
                <div class="mar25">
                    <a href="{{URI_ROOT}}/login/forgot">Quên mật khẩu?</a>
                </div>
                <div style="margin-top: 50px">
                    Đăng nhập bằng tài khoản khác:<br>
                    <button class='lg-bt-google lg-bt' href-click="{{URI_ROOT}}/login/app/google">GOOGLE</button>
                    <button class='lg-bt-facebook lg-bt' href-click="{{URI_ROOT}}/login/app/facebook">FACEBOOK</button>
                    <button class='lg-bt-twitter lg-bt' href-click="{{URI_ROOT}}/login/app/twitter">TWITTER</button>
                    <button class='lg-bt-yahoo lg-bt' href-click="{{URI_ROOT}}/login/app/yahoo">YAHOO</button>
                </div>
            </div>
        </div>

        <div class="lg-col-right">
            <div class="lg-header">Bạn chưa có tài khoản?</div>
            <ul class="lg-ul">
                <li>Nhận khuyến mại nhanh nhất.</li>
                <li>Đặt và nhận hàng đơn giản.</li>
                <li>Mua sắm với giá rẻ nhất.</li>
                <li>Chất lượng cao.</li>
            </ul>
            <button class='lg-bt-reg lg-bt' href-click="{{URI_ROOT}}/register">Đăng kí ngay !</button>
        </div>
    </div> 
</div>