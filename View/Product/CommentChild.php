<div class="media border p-3">
        <img src="{{YUH_URI_ROOT}}/{{@Data:avatar}}" alt="{{@Data:user}}" id="id{{@Data:id}}" class="mr-3 mt-3 rounded-circle" style="width:60px;">
        <div class="media-body">
                <div style="margin-bottom: 10px">
                        <span style="font-weight: bold; font-size: 20px; margin-right: 20px;">{{@Data:user}}</span>
                        <small>Đăng ngày {{@Data:date}}</small>
                </div>
                <p>{{@Data:content}}</p>
                {{@Data:child}}

                @if @Data:id_mem_rep != @Data:idlogged
                        <p><a onclick = "reply('{{@Data:user}}', {{@Data:id_com_rep}})" style="color: blue"> Trả lời</a></p>
                @endif
        </div>
</div>
<br>