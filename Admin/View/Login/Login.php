<div id="body-home" class="pd-top-80">
    <div class="lg-container">
        <div class="lg-col-left">
            <div class="lg-header">Đăng nhập</div>
            <div >
                <form action="{{URI_ROOT}}/login/submit" method="POST" name="fLogin"  >
                    <div class="lg-input">
                        <input type="text" name="email" value="" placeholder="Nhập email hoặc username" required>
                        <div></div>
                    </div>
                    <div class="lg-input">
                        <input type="password" name="pass" value="" placeholder="Nhập mật khẩu" minlength="6" required>
                        <div></div>
                    </div>
                     
                    <br>
                    <button type="submit" class="lg-bt lg-bt-log">ĐĂNG NHẬP</button>
                </form>
                
               
            </div>
        </div>

    </div> 
</div>