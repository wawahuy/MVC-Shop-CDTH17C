<script>
    const CMT_DB = "Đăng bài";
    const CMT_DBL = "<span class=\"spinner-border spinner-border-sm\"></span>Đang Đăng...";
    var comment_reply = null;

    function postComment(e){
        if(e.innerHTML == CMT_DB) {
            
            /**
             * Kiểm tra comment
             */
            var tc = document.getElementById("tex_comment");
            if(tc.value == ""){
                swal("Vui lòng nhập comment", "", "error");
                return;
            }

            /**
             * Load
             */
            e.innerHTML = CMT_DBL;
            
            $.post('{{YUH_URI_ROOT}}/product_comment/add/{{@Data:product->id}}', {
                comment: tc.value,
                reply: comment_reply
            }, (result)  => {
                setTimeout( () => {

                    /**
                     * Kiểm tra quá trình comment
                     */
                    e.innerHTML = CMT_DB;
                    var data = JSON.parse(result);
                    if(data.code == "success"){
                        tc.value = "";
                        loadComment(data.data);
                    } 
                    swal(data.message, "", data.code);
                }, 500);
            });
        }
    }
    

    function loadComment($dt){

    }

</script>

<div class="container mt-3" style="border-bottom: none; background-color: white">
  @if !@Data:page_logged
    <p>Vui lòng đăng nhập để có thể bình luận</p><br>
  @else
    <div style="margin-bottom: 50px;">
        <div class="form-group shadow-textarea">
            <textarea class="form-control z-depth-1" id="tex_comment" rows="3" placeholder="Write something here..."></textarea>
        </div>
        <button class="btn btn-primary" onclick = "postComment(this)">Đăng bài</button>
    </div>
  @endif

  <div class="media border p-3">
    <img src="{{YUH_URI_ROOT}}/Resource/img/account.png" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
    <div class="media-body">
        <div style="margin-bottom: 10px">
          <span style="font-weight: bold; font-size: 20px; margin-right: 20px;">Huy Nguyễn</span>
          <small>Đăng ngày 11/11/2019</small>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        
    </div>
  </div>

</div>
