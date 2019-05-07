@call JS_Call_When_Onload("Reg.init")

<div id="body-home" class="pd-top-80">

    <div class="lg-container">

        <div class="lg-col-left w55pt">
            <div class="lg-header">Tạo tài khoản</div>
            <div>
                <form action="{{URI_ROOT}}/register/submit" method="POST" name="fReg">
                    <div class="lg-input">
                        <input type="text" name="username" placeholder="Username (*)" minlength="3" required>
                        <div></div>
                    </div>
                    <div class="lg-input">
                        <input type="email" name="email" placeholder="Email (*)" required>
                        <div></div>
                    </div>
                    <div class="lg-input">
                        <input type="password" name="pass" placeholder="Mật khẩu (*)" minlength="6" required>
                        <div></div>
                    </div>
                    <div class="lg-input">
                        <input type="password" name="repass" placeholder="Nhập lại mật khẩu (*)" minlength="6" required>
                        <div></div>
                    </div>
                    <div class="lg-input">
                        <input type="text" name="fullname" placeholder="Họ và tên (*)" minlength="3" required>
                        <div></div>
                    </div>
                    <div class="lg-input">
                        <input type="phone" name="phone" placeholder="SĐT (*)" minlength="8" required>
                        <div></div>
                    </div>

                    <div class="lg-input">
                        <input type="date" name="birthday" placeholder="Ngày Sinh (*)" required>
                        <div></div>
                    </div>

                    <div class="lg-input">
                        <select name="sex">
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                        </select>
                        <div></div>
                    </div>
                    
                    <input type="hidden" name="check_reg" value="1" />
                    <input type="checkbox" class="lg-check" name="private" value="1" required> Đồng ý với <u><a href="rules.html">điều khoản sử dụng</a></u>.
                    <br>
                    <button type="submit" class="lg-bt lg-bt-log">ĐĂNG KÍ</button>
                </form>
            </div>
        </div>

        <div class="lg-col-right w45pt">
            <div style="margin-bottom: 80px">
                <button class='lg-bt-google lg-bt' href-click="{{URI_ROOT}}/login/app/google">GOOGLE</button>
                <button class='lg-bt-facebook lg-bt' href-click="{{URI_ROOT}}/login/app/facebook">FACEBOOK</button>
                <button class='lg-bt-twitter lg-bt' href-click="{{URI_ROOT}}/login/app/twitter">TWITTER</button>
                <button class='lg-bt-yahoo lg-bt' href-click="{{URI_ROOT}}/login/app/yahoo">YAHOO</button>
            </div>

            <div style="margin-bottom: 80px">
                <div class="lg-header">Tôi đã có tài khoản:</div>
                <button class='lg-bt-reg lg-bt' href-click="{{URI_ROOT}}/login">ĐĂNG NHẬP</button>
            </div>

            <div class="lg-header">Khi bạn sở hửu 1 tài khoản:</div>
            <ul class="lg-ul">
                <li>Nhận khuyến mại nhanh nhất.</li>
                <li>Đặt và nhận hàng đơn giản.</li>
                <li>Mua sắm với giá rẻ nhất.</li>
                <li>Chất lượng cao.</li>
            </ul>
        </div>
    </div> 
</div>