
<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Đổi mật khẩu</h1>
    </div>

    <form action="{{YUH_URI_ROOT}}/profile/changepassword" method="POST" id="f1">
        <div class="form-group">
            <label for="po">Mật khẩu cũ:</label>
            <input type="password" name="passold" class="form-control" id="po" placeholder="Password" require>
        </div>

        <div class="form-group">
            <label for="po">Mật khẩu mới:</label>
            <input type="password" name="passnew" class="form-control" id="pn1" placeholder="Password" require>
        </div>
        
        <div class="form-group">
            <label for="po">Mật khẩu cũ:</label>
            <input type="password" class="form-control" id="pn2" placeholder="Password" require>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        $("#f1").submit(function (e){
            if($("#pn1").val() != $("#pn2").val()){
                swal("Lỗi", "Nhập lại sai mật khẩu", "error");
                e.preventDefault();
            }
        });
    </script>


</div>