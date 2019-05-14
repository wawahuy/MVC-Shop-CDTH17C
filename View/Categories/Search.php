
<form action="" method="GET" onsubmit="return search_();">
    <div class="input-group">
        <select class="form-control col-3" name="sort">
            <option value="new"  {{@Data:sort_data == "new" ? "selected" : ""}}>Mới nhất</option>
            <option value="price-max" {{@Data:sort_data == "price-max" ? "selected" : ""}}>Giá cao đến nhất</option>
            <option value="price-min" {{@Data:sort_data == "price-min" ? "selected" : ""}}>Giá nhất đến cao</option>
            <option value="view" {{@Data:sort_data == "view" ? "selected" : ""}}>Lượt xem nhiều nhất</option>
            <option value="sale" {{@Data:sort_data == "sale" ? "selected" : ""}}>Giảm giá nhiều nhất (tiền)</option>
            <option value="sold" {{@Data:sort_data == "sold" ? "selected" : ""}}>Mua nhiều nhất</option>
        </select>
        <input type="text" class="form-control col-8" name="search" id="id_search" placeholder="Tìm kiếm vơi chuyên mục 'XYZ'" value="{{@Data:search_data}}">
        <input class="btn btn-default col-1" style="border-radius: 0 3px 3px 0; border: 1px solid #ccc;" type="submit" value="Tìm"/>
    </div>
</form>

<script>

    function search_(){
        if(document.getElementById("id_search").value == ""){
            swal("Chú ý", "Bạn cần nhập nội dung tìm kiếm trước!", "warning");
            return false
        }
        return true;
    }


</script>