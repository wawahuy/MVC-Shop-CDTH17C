<tr>
     <td>
        {{@Data:username}}
     </td>
     <td>
     {{@Data:fullname}}
     </td>
     <td>
     {{@Data:phone}}
     </td>
     <td>

      @if @Data:status == 1
         <a href="{{YUH_URI_ROOT}}/user_management/active/{{@Data:id}}"><button type="button" class="btn btn-warning">Bỏ Cấm</button></a>
      @else
         @if @Data:status == 0
            <a href="{{YUH_URI_ROOT}}/user_management/deactive/{{@Data:id}}"><button type="button" class="btn btn-warning">Cấm</button></a>  
         @endif
      @endif

      <a href="{{YUH_URI_ROOT}}/user_management/remove/{{@Data:id}}"><button type="button" class="btn btn-danger">Xóa</button></a>

      </td>
</tr>
 