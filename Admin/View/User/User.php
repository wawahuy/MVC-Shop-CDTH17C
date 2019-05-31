<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Danh sách khách hàng</h1>
    </div>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:20%">Tên đăng nhập</th>
                <th style="width:30%">Tên khách hàng</th>
                <th style="width:20%">SĐT</th>
                <th style="width:35%">Tùy chọn</th>

            </tr>
        </thead>
    <tbody>
                            {{@Data:list_user}}
    </tfoot>
    </table>

</div>