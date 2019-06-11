<tr>
    <td>
        {{@Data:id}}
    </td>
    <td>
        {{@Data:date}}
    </td>
    <td>
        {{number_format(@Data:price, 0, '', ',')}}vnđ
    </td>
    <td>
        <b>{{@Data:status}}</b>
    </td>
    <td>
        <?php
             $par = $_SERVER['QUERY_STRING'];
             $par = preg_replace('/action=([\w]+)/', '', $par);
             $par = preg_replace('/^&/', '', $par);
        ?>

        <a href="{{YUH_URI_ROOT}}/order_management/view/{{@Data:id}}"><button type="button" class="btn btn-success">Xem</button></a>
        @if @Data:status == "Chờ xữ lí"
            <a href="{{YUH_URI_ROOT}}/order_management/{{@Data:id}}?action=confirm&{{$par}}"><button type="button" class="btn btn-warning">Duyệt</button></a>
        @endif

        @if @Data:status == "Đã xác nhận"
            <a href="{{YUH_URI_ROOT}}/order_management/{{@Data:id}}?action=complete&{{$par}}"><button type="button" class="btn btn-warning">Hoàn tất</button></a>
        @endif

        @if @Data:status != "Hủy" &&  @Data:status != "Đã hoàn thành"
            <a href="{{YUH_URI_ROOT}}/order_management/{{@Data:id}}?action=cancel&{{$par}}"><button type="button" class="btn btn-danger">Hủy</button></a>
        @endif
    </td>
</tr>
 