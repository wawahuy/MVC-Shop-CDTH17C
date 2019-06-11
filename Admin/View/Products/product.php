<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Danh sách sản phẩm</h1>
    </div>
    <hr>

    <div style="margin: 30px 0;">
        <a href="{{YUH_URI_ROOT}}/product_management/addproduct"><button class="btn btn-success">Thêm mới sản phẩm</button></a>
    </div>


    <form action="" method="GET" id="fse">
        <div class="input-group">

        <div class="row" style="width: 100%; margin-left: 5px;" id="search_container">

            <select class="form-control col-3" onchange="">
                <option value="name">Tìm theo tên</option>
                <option value="categorie">Tìm theo chuyên mục</option>
            </select>
            <input type="text" class="form-control col-7" placeholder="Tìm kiếm" value="">
            <input onlick="return addSearch();" class="btn btn-default col-1" style="border-radius: 0 3px 3px 0; border: 1px solid #ccc;" type="submit" value="Thêm"/>
            <input class="btn btn-default col-1" style="border-radius: 0 3px 3px 0; border: 1px solid #ccc;" type="submit" value="Tìm"/>

            <input type="text" class="form-control col-3" value="Tìm theo tên" readonly>
            <input type="text" class="form-control col-7" value="Test" readonly>
            <input onlick="return addSearch();" class="btn btn-default col-2" style="border-radius: 0 3px 3px 0; border: 1px solid #ccc;" type="submit" value="Gỡ bỏ"/>
            

        </div>

        </div>


    </form>

    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:20%">Ảnh</th>
                <th style="width:20%">Tên sản phẩm</th>
                <th style="width:15%">Còn lại</th>
                <th style="width:15%">Giá</th>
                <th style="width:15%">Đã bán</th>
                <th style="width:20%">Tùy chọn</th>
            </tr>
        </thead>
    <tbody>
                            {{@Data:product_list}}
    </tfoot>
    </table>

</div>


<script>
</script>