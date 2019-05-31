<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Danh sách dản phẩm</h1>
    </div>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:25%">Tên sản phẩm</th>
                    
                <th style="width:15%">Còn lại</th>
                <th style="width:15%">Giá</th>
                <th style="width:15%">Đã bán</th>
                <th style="width:35%">Tùy chọn</th>
            </tr>
        </thead>
    <tbody>
                            {{@Data:product_list}}
    </tfoot>
    </table>

</div>