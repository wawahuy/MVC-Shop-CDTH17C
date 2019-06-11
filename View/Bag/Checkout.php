<div id="body-home" style="padding-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="jumbotron">
                    <h1 class="display-3">Đặt hàng thành công</h1>
                    <p class="lead">Địa chỉ: {{@Data:address}}</p>
                    <p class="lead">SĐT: {{@Data:phone}}</p>
                    <hr class="my-2">
                    <p>Xem thông tin</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="{{YUH_URI_ROOT}}/profile/order/{{@Data:idorder}}" role="button">Xem Đơn Hàng</a>
                    </p>
                </div>

            </div>
        </div>
    </div>

</div>