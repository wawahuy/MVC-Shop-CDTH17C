<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Đơn hàng - #{{@Data:order_id}}</h1>
        <div class="box">
            <p><b>Trạng thái:</b> {{@Data:order_status}}</p>
            <p><b>Địa chỉ:</b> {{@Data:order_address}}</p>
            <p><b>SĐT:</b> {{@Data:order_phone}}</p>
            <p><b>Tổng tiền:</b> {{@Data:order_price}} VNĐ</p>
            
        </div>
        <div class="box">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:40%">Tên sản phẩm</th>
                        <th style="width:18%">Giá</th>
                        <th style="width:18%">Số lượng</th>
                        <th style="width:25%" class="text-center">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    {{@Data:order_element}}
                </tfoot>
            </table>
        </div>
    </div>


</div>