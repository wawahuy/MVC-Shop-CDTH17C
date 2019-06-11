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

    <hr>

    <form action="" method="GET" id="fse" onchange="document.getElementById('fse').submit()">
        <div class="input-group">
            <select class="form-control col-3" name="sort" >
                <option value="all" {{@Data:sort == "all" ? "selected" : ""}}>Tấc cả</option>
                <option value="wait" {{@Data:sort == "wait" ? "selected" : ""}}>Đơn hàng chờ duyệt</option>
                <option value="cancel" {{@Data:sort == "cancel" ? "selected" : ""}}>Đơn hàng hủy</option>
                <option value="confirm" {{@Data:sort == "confirm" ? "selected" : ""}}>Đơn hàng đã duyệt</option>
                <option value="complete" {{@Data:sort == "complete" ? "selected" : ""}}>Đơn hàng đã hoàn thành</option>
            </select>

            <input type='date' class="form-control col-4"  name="start" value="{{@Data:start}}"/>
            <input type='text' class="form-control col-1" disabled value="Đến"/>
            <input type='date' class="form-control col-4"  name="end" value="{{@Data:end}}"/>

        </div>
    </form>

    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:15%">Mã đơn hàng</th>
                <th style="width:20%">Ngày đặt</th>
                <th style="width:15%">Thành tiền</th>
                <th style="width:25%">Trạng thái</th>
                <th style="width:35%">Tùy chọn</th>
            </tr>
        </thead>
    <tbody>
                            {{@Data:order_list}}
    </tfoot>
    </table>

</div>