<form action="{{YUH_URI_ROOT}}/bag" method="post">
<tr>
    <td data-th="Product">
        <div class="row">
            <div class="col-sm-4">
                <img src="{{YUH_URI_ROOT}}/{{@Data:image}}" alt="{{@Data:title}}" class="img-responsive" width="100">
            </div>
            <div class="col-sm-8">
                <a href="{{YUH_URI_ROOT}}/product/{{@Data:id}}">{{@Data:title}}</a>
            </div>
        </div>
    </td>
    <td data-th="Price">{{number_format(@Data:price, 0, '', ',')}} VNĐ</td>
    <td data-th="Quantity"><input name="num" class="form-control text-center" value="{{@Data:num}}" type="number">
    </td>
    <td data-th="Subtotal" class="text-center">{{number_format(@Data:allprice, 0, '', ',')}} VNĐ</td>
    <td class="actions" data-th="">

        <input type="hidden" name="product" value="{{@Data:id}}"" />
        <input type="submit" name="update" class="btn btn-info btn-sm" style="margin-bottom: 10px;" value="Sửa" />
        <input type="submit" name="delete" class="btn btn-danger btn-sm" style="margin-bottom: 10px;" value="Xóa" />

    </td>
</tr>
</form>