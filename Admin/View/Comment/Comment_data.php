<tr>
      <td>
         {{@Data:id}}
      </td>
      <td>
      {{@Data:noidung}}
      </td>
      <td>
      {{@Data:thoigian}}
      </td>
      <td>
      {{@Data:sanpham}}
      </td>

      <td>
         @if @Data:trangthai==0
         <a href="{{YUH_URI_ROOT}}/comment_management/confirm/{{@Data:id}}"><button type="button" class="btn btn-success">Duyệt</button></a>
         @endif 
         <a href="{{YUH_URI_ROOT}}/comment_management/remove/{{@Data:id}}"><button type="button" class="btn btn-warning">Xóa</button></a>
      </td>
</tr>
 