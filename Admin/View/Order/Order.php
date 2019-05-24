<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Danh sách đơn hàng</h1>
    </div>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:15%">Mã đơn hàng</th>
                <th style="width:25%">Ngày đặt</th>
                <th style="width:15%">Thành tiền</th>
                <th style="width:25%">Trạng thái</th>
                <th style="width:22%" class="text-center"></th>
                <th style="width:10%"> </th>
            </tr>
        </thead>
    <tbody>
                            {{@Data:order_list}}
    </tfoot>
    </table>

</div>