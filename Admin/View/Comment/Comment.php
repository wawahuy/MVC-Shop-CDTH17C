<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Danh sách bình luận</h1>
    </div>
    
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:15%">Mã bình luận</th>
                <th style="width:25%">Nội dung</th>
                <th style="width:25%">Thời gian</th>
                <th style="width:15%">Sản phẩm</th>
                <th style="width:35%">Tùy chọn</th>
            </tr>
        </thead>
    <tbody>
                            {{@Data:comment_list}}
    
    </tfoot>
    </table>

</div>