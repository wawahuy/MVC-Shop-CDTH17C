<tr>
    <td data-th="Product">
        <div class="row">
            <div class="col-sm-4">
                <img src="{{YUH_URI_ROOT}}/{{@Data:image}}" alt="{{@Data:title}}" class="img-responsive" width="100">
            </div>
            <div class="col-sm-8">
                <h4 class="nomargin">{{@Data:title}}</h4>
            </div>
        </div>
    </td>
    <td data-th="Price">{{number_format(@Data:price, 0, '', ',')}} VNĐ</td>
    <td data-th="Quantity"><input class="form-control text-center" value="{{@Data:num}}" type="number">
    </td>
    <td data-th="Subtotal" class="text-center">{{number_format(@Data:allprice, 0, '', ',')}} VNĐ</td>
    <td class="actions" data-th="">
        <button class="btn btn-info btn-sm" style="margin-bottom: 10px;">
            Sửa
        </button>
        <button class="btn btn-danger btn-sm">
            Xóa
        </button>
    </td>
</tr>