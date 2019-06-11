<tr>
    <td data-th="Product">
        <div class="row">
            <div class="col-sm-4">
                <img src="{{YUH_URI_ROOT}}/../{{@Data:image}}" alt="{{@Data:title}}" class="img-responsive" width="100">
            </div>
            <div class="col-sm-8">
                <h4 class="nomargin">
                    <a href="{{YUH_URI_ROOT}}/../product/{{@Data:id}}">{{@Data:title}}</a>
                </h4>
            </div>
        </div>
    </td>
    <td data-th="Price">{{number_format(@Data:price, 0, '', ',')}} VNĐ</td>
    <td data-th="Quantity">{{@Data:num}}</td>
    <td data-th="Subtotal" class="text-center">{{number_format(@Data:allprice, 0, '', ',')}} VNĐ</td>
    
</tr>