<style>
    .product {
        position: relative;
        margin: 13px;
    }

    #product-input {
        width: 100%;
        height: 100%;
        position: absolute;
        opacity: 0;
        top: 0;
        left: 0;
        cursor: grab;
    }

    .product-img {
        width: 190px;
        height: 190px;
    }

    .product-del {
        font-weight: bold;
        padding: 5px;
    }

    #product-submit {
        width: 200px;
        display: none;
    }

    .form-group {
        margin-bottom: 40px;
    }
</style>

<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Thêm  mới sản phẩm</h1>
    </div>

    <div class="panel-body">

        <form action="{{YUH_URI_ROOT}}/product_management/addproduct" class="form-horizontal" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Tên sản phẩm</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="ten" id="ten" placeholder="Nhập tên sản phẩm" require>
                </div>
            </div> 


            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Số lượng:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="soluong" value=0 id="soluong" placeholder="Nhập số lượng" require>
                </div>
            </div>

            <div class="form-group">
                <label for="thongtin" class="col-sm-3 control-label">Thông tin sản phẩm</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="thongtin" require></textarea>
                </div>
            </div>
            
        
            <div class="form-group">
                <label for="gia" class="col-sm-3 control-label">Giá sản phẩm</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="gia" value=0 require>
                </div>
            </div>

            <div class="form-group">
                <label for="gia" class="col-sm-3 control-label">Giảm giá sản phẩm</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="giamgia" value=0 min=0 max=100 require>
                </div>
            </div>

            <div class="form-group">
                <label for="sao" class="col-sm-3 control-label">Đánh giá chung (sao):</label>
                <div class="col-sm-3">
                    <select class="form-control" name="sao" require>
                        <option value="1">1 sao</option>
                        <option value="2">2 sao</option>
                        <option value="3">3 sao</option>
                        <option value="4">4 sao</option>
                        <option value="5">5 sao</option>
                    </select>
                </div>
                <i>(*) Đánh giá này do Admin đặt ra về mặt hàng của mình.</i>
            </div> 


            <div class="form-group">
                <label for="chuyenmuc" class="col-sm-3 control-label">Chuyên mục:</label>
                <div class="col-sm-3">
                    <select class="form-control" name="chuyenmuc" require>
                        @foreach @Data:chuyenmuc as $cm
                            <option value="{{$cm['categorie_id']}}">ID:{{$cm['categorie_id']}} - {{$cm['categorie_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <i>(*) Chỉ những chuyên mục không có chuyên mục con mới được thêm sản phẩm.</i>
            </div> 

            <div class="form-group">
                <label for="hinh" class="col-sm-3 control-label">Hình ảnh:</label>
                <div class="product">
                    <img class="product-img" id="product-img" src="{{YUH_URI_ROOT}}/Resource/img/addimg.png"/>
                    <input id="product-input" name="hinh" type="file" required accept="image/x-png,image/gif,image/jpeg">
                </div>
            </div>

            <hr>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <input type="submit" class="btn btn-primary" value="Thêm" />
                </div>
            </div>
        </form>

    </div>

</div> 


<script>

$("#product-input").change(function (e){
    readURL(this);
});

function readURL(input) {
    $('#product-submit').hide();
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#product-img').attr('src', e.target.result);
            $('#product-submit').show();
        }


        reader.readAsDataURL(input.files[0]);
    }
}

</script>