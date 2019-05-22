<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Đơn hàng</h1>
    </div>

    @if count(@Data:orders) == 0
        Chưa có đơn hàng nào!
    @else
        @foreach @Data:orders as $order
            <a href="{{YUH_URI_ROOT}}/profile/order/{{$order['order_id']}}">
                <div class="box">
                    <div class="row">
                        <div class="col-4">ID: #{{$order["order_id"]}}<br>Ngày: {{$order["order_date"]}}</div>
                        <div class="col-4">Trạng thái: {{$order["order_status"]}}</div>
                        <div class="col-4">Tổng tiền: {{$order["order_price"]}}</div>
                    </div>
                </div>
            </a>
        @endforeach
        @endif


</div>