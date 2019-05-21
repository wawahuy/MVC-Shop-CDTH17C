<style>
    .bg-header {
        padding: 10px;
        margin: 0;
    }
</style>


<div id="body-home" style="padding-top: 100px;">
    <div class="bg-ctainer">
        <div class="bg-cproduct">
            <div class="bg-header mr0">
                Túi hàng <span id="bg-count" class="bg-count">({{@Data:num_product}} sản phẩm)</span>
            </div>

            <!--phần sản phẩm-->
            <div id="cproduct">
                <div class="bg-dl-child">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:40%">Tên sản phẩm</th>
                                <th style="width:15%">Giá</th>
                                <th style="width:15%">Số lượng</th>
                                <th style="width:22%" class="text-center">Thành tiền</th>
                                <th style="width:10%"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{@Data:list_cart}}
                        </tfoot>
                    </table>
                </div>
            </div>


        </div>

        <div class="bg-cdeltail">
            <div class="bg-header mr0">Thành tiền</div>
            <div class="bg-dl-child">
                <span>Sản phẩm: </span>
                <span id="giaSP">{{number_format(@Data:price_product, 0, '', ',')}} VNĐ</span>
            </div>

            <div class="bg-dl-child">
                <span>Tổng: </span>
                <span id="giaTC" style="font-weight: bold;">{{number_format(@Data:price_all, 0, '', ',')}} VNĐ</span>
            </div>

            @if Session::IsLogged()
                <form action="{{YUH_URI_ROOT}}/bag/checkout" method="post">
                    <div class="bg-dl-child">
                        <span>Vận chuyển: </span>

                        <div style="margin-top: 10px; border-left: 5px orange solid; padding-left: 5px">
                            <small>
                                @if count(@Data:contacts) == 0
                                    Chưa có liên hệ [<a href="{{YUH_URI_ROOT}}/profile/contact">Thêm</a>]
                                @else
                                    <select name="contacts">
                                    @foreach @Data:contacts as $contact 
                                        <option value="{{$contact['contact_id']}}">
                                        {{$contact["contact_phone"]}} - {{$contact["contact_address"]}}
                                        </option>
                                        @endforeach
                                    </select>
                                @endif
                            </small>
                        </div>
                    </div>

                    <div class="bg-dl-child" style="border: none;">
                            <button class="buy">Đặt Hàng</button>
                    </div>
                </form>
            @else
                <div class="bg-dl-child" style="border: none; text-align:center;">
                    Vui lòng 
                        <a href="{{YUH_URI_ROOT}}/login" style="color: green">Đăng nhập</a>
                        Để đặt hàng
                </div>
                @endif

            
        </div>
    </div>
    <div class="bg-yeuthich">
        <div class="bg-header" style="width: 95%; margin: 30px">
            Có thể bạn sẽ thích?
        </div>
        <!--phần này update sau-->
        <div class="pd-slides-view" style="margin-top: 0;">
            <div class="btR"></div>
            <div class="btL"></div>
            <div class="pd-slides-container"></div>
        </div>
        <!--ends slide nổi bật-->
    </div>
</div>