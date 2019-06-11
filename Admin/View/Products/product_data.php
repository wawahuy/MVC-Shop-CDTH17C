<tr>
      <td>
         <img src="{{YUH_URI_ROOT}}/../{{@Data:image}}" alt="{{@Data:name }}"  style="width: 80%;"/>
      </td>
      <td>
         {{@Data:name }}
      </td>
      <td>
         {{@Data:remai }}
      </td>
      <td>
        {{number_format(@Data:price, 0, '', ',')}}vnđ
      </td>
      <td>
         {{@Data:sold }}
      </td>
      <td>
         <a href="{{YUH_URI_ROOT}}/product_management/edit/{{@Data:id}}"><button type="button" class="btn btn-info">Sửa</button></a>
         <a href="{{YUH_URI_ROOT}}/product_management/remove/{{@Data:id}}"><button type="button" class="btn btn-warning">Xóa</button></a>
      </td>
</tr>
 