<style>
    .avatar {
        position: relative;
        text-align: center;
    }

    #avatar-input {
        width: 100%;
        height: 100%;
        position: absolute;
        opacity: 0;
        top: 0;
        left: 0;
        cursor: grab;
    }

    .avatar-img {
        width: 190px;
        height: 190px;
    }

    .avatar-del {
        font-weight: bold;
        padding: 5px;
    }

    #avatar-submit {
        width: 200px;
        display: none;
    }
</style>

<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Thông tin tài khoản</h1>
    </div>

    <form action="{{YUH_URI_ROOT}}/profile/user" method="POST" enctype="multipart/form-data">

        <div class="row">
            <div class="col-sm-4">
                <div class="avatar">
                    <img class="avatar-img" id="avatar-img" src="{{YUH_URI_ROOT}}/{{@Data:avatar}}"/>
                    <div class="avatar-del">Ấn để thay đổi</div>
                    <input id="avatar-input" name="avatar" type="file" required accept="image/x-png,image/gif,image/jpeg">
                </div>

                <input class = "btn btn-success" type="submit" value="Thay đổi" id="avatar-submit">
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="email" class="form-control-plaintext" readonly id="email" value="kakahuy99@gmail.com">
                </div>

                <div class="form-group">
                    <label for="username"><b>Tài khoản:</b></label>
                    <input type="text" class="form-control-plaintext" readonly id="username" value="{{@Data:username}}">
                </div>

                <div class="form-group">
                    <label for="fullname"><b>Họ và tên:</b></label>
                    <input type="text" class="form-control-plaintext" readonly id="fullname" value="{{@Data:fullname}}">
                </div>

                <div class="form-group">
                    <label for="sdt"><b>Số điện thoại:</b></label>
                    <input type="text" class="form-control-plaintext" readonly id="sdt" value="{{@Data:phone}}">
                </div>

                <div class="form-group">
                    <label for="birthday"><b>Ngày sinh:</b></label>
                    <input type="text" class="form-control-plaintext" readonly id="birthday" value="{{@Data:birthday}}">
                </div>
                
                <div class="form-group">
                    <label for="sex"><b>Giới tính:</b></label>
                    <input type="text" class="form-control-plaintext" readonly id="sex" value="{{@Data:sex}}">
                </div>
            </div>
        </div>
        
    </form>


</div>


<script>

$("#avatar-input").change(function (e){
    readURL(this);
});

function readURL(input) {
    $('#avatar-submit').hide();
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#avatar-img').attr('src', e.target.result);
            $('#avatar-submit').show();
        }


        reader.readAsDataURL(input.files[0]);
    }
}

</script>