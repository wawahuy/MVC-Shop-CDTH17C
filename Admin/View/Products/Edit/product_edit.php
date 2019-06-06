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
        <h1>Sửa sản phẩm - #ID: {{@Data:id}}</h1>
    </div>

    <div class="panel-body">

        <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="hinhcu" value = "{{@Data:image}}">

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Tên sản phẩm</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="ten" value = "{{@Data:name}}" id="ten" placeholder="Nhập tên sản phẩm" require>
                </div>
            </div> 


            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Số lượng:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="soluong" value = "{{@Data:num_remai}}" id="soluong" placeholder="Nhập số lượng" require>
                </div>
            </div>

            <div class="form-group">
                <label for="thongtin" class="col-sm-3 control-label">Thông tin sản phẩm</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="thongtin" require>{{@Data:deltail}}</textarea>
                </div>
            </div>
            
        
            <div class="form-group">
                <label for="gia" class="col-sm-3 control-label">Giá sản phẩm</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="gia" value = {{@Data:price}} require>
                </div>
            </div>

            <div class="form-group">
                <label for="gia" class="col-sm-3 control-label">Giảm giá sản phẩm</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="giamgia" value = {{@Data:sale}} min=0 max=100 require>
                </div>
            </div>

            <div class="form-group">
                <label for="sao" class="col-sm-3 control-label">Đánh giá chung (sao):</label>
                <div class="col-sm-3">
                    <select class="form-control" name="sao" require>
                        <option value="1" {{@Data:star == 1 ? "selected" : "" }}>1 sao</option>
                        <option value="2" {{@Data:star == 2 ? "selected" : "" }}>2 sao</option>
                        <option value="3" {{@Data:star == 3 ? "selected" : "" }}>3 sao</option>
                        <option value="4" {{@Data:star == 4 ? "selected" : "" }}>4 sao</option>
                        <option value="5" {{@Data:star == 5 ? "selected" : "" }}>5 sao</option>
                    </select>
                </div>
                <i>(*) Đánh giá này do Admin đặt ra về mặt hàng của mình.</i>
            </div> 


            <div class="form-group">
                <label for="chuyenmuc" class="col-sm-3 control-label">Chuyên mục:</label>
                <div class="col-sm-3">
                    <select class="form-control" name="chuyenmuc" require>
                        @foreach @Data:chuyenmuc as $cm
                            <option {{@Data:categorie_id == $cm['categorie_id'] ? "selected" : "" }} value="{{$cm['categorie_id']}}">ID:{{$cm['categorie_id']}} - {{$cm['categorie_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <i>(*) Chỉ những chuyên mục không có chuyên mục con mới được thêm sản phẩm.</i>
            </div> 

            <div class="form-group">
                <label for="hinh" class="col-sm-3 control-label">Hình ảnh:</label>
                <div class="product">
                    <img class="product-img" id="product-img" src="{{YUH_URI_ROOT}}/../{{@Data:image}}"/>
                    <input id="product-input" name="hinh" type="file" accept="image/x-png,image/gif,image/jpeg">
                </div>
            </div>

            <hr>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <input type="submit" class="btn btn-primary" value="Sửa" />
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