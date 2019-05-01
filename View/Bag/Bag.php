<?php
    include 'header.php';
    JS_Add_Fix_Page();
    JS_Call_When_Onload('Bag.init');
?>


        <div id="body-home" style="padding-top: 100px;">
            <div class="bg-ctainer">
                <div class="bg-cproduct">
                    <div class="bg-header mr0">
                            Túi hàng <span id="bg-count" class="bg-count">(0 sản phẩm)</span>
                    </div>

                    <!--phần sản phẩm-->
                    <div id="cproduct">
                            <div class="bg-dl-child">
                                Chưa có sản phẩm để thanh toán!
                            </div>
                    </div>
                    

                </div>

                <div class="bg-cdeltail">
                    <div class="bg-header mr0">Thành tiền</div>
                    <div class="bg-dl-child">
                        <span>Sản phẩm: </span>
                        <span id="giaSP">0đ</span>
                    </div>
                    <div class="bg-dl-child">
                        <span>Vận chuyển: </span>
                        <span id="giaVC">0đ</span>
                    </div>
                    <div class="bg-dl-child">
                        <span>Tổng: </span>
                        <span id="giaTC" style="font-weight: bold;">0đ</span>
                    </div>
                    <div class="bg-dl-child" style="border: none;">
                        <button class="buy">Đặt Hàng</button>
                    </div>

                    <div class="bg-header mr0" style="margin-top: 40px;">Khuyến mãi</div>
                    <div class="bg-dl-child">
                        <form action="?act=cou" class="cou">
                            <input type="text" placeholder="Nhập mã khyến mãi" required>
                            <input type="submit" value="Kiểm Tra">
                        </form>
                        <div style="clear: both;"></div>
                        <i>(*) Ưu đãi đặc biệt nếu bạn sở hữu nó!</i>
                    </div>
                </div>
            </div>
            <div class="bg-yeuthich">
                <div class="bg-header" style="width: 95%">
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
	
	 <!--phần footer-->
            
    <?php
            include 'footer.php';
        ?>
</html>
