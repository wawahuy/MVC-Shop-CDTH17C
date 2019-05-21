<style>
    .box {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 5px 30px 5px;
    }
</style>


<div class="container" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px;">

    <div class="page-header" style="margin-bottom: 30px;">
        <h1>Danh sách liên hệ</h1>
    </div>


    @foreach @Data:contacts as $contact
        <div class="box">
            <form action="{{YUH_URI_ROOT}}/profile/contact" method="POST" id="f1">
                <div class="form-group">
                    <label for="sdt"><b>Số điện thoại:</b></label>
                    <input type="number" class="form-control-plaintext"  id="sdt" name="phone" value="{{$contact['contact_phone']}}">
                </div>
                <div class="form-group">
                    <label for="address"><b>Địa chỉ:</b></label>
                    <input type="text" class="form-control-plaintext"  id="address" name="address" value="{{$contact['contact_address']}}">
                </div>
                <input type="hidden" name="idcontact" value="{{$contact['contact_id']}}" />
                <button type="submit" name="action" value="update" class="btn btn-primary">Sửa liên hệ</button>
                <button type="submit" name="action" value="delete" class="btn btn-primary">Xóa liên hệ</button>
            </form>
        </div>
        @endforeach


    <div class="box" style="background-color: white;">
        <h3>Thêm liên hệ mới</h3>
        <form action="{{YUH_URI_ROOT}}/profile/contact" method="POST" id="f1">
            <div class="form-group">
                <label for="sdt"><b>Số điện thoại:</b></label>
                <input type="number" class="form-control"  id="sdt" name="phone" placeholder="0123456789">
            </div>
            <div class="form-group">
                <label for="address"><b>Địa chỉ:</b></label>
                <input type="text" class="form-control"  id="address" name="address" placeholder="A, B, C, D">
            </div>
            <button type="submit" name="action" value="add" class="btn btn-primary">Thêm liên hệ mới</button>
        </form>
    </div>

</div>