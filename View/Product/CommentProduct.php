<script>
    const CMT_DB = "Đăng bài";
    const CMT_DBL = "<span class=\"spinner-border spinner-border-sm\"></span>Đang Đăng...";
    var comment_reply = null;
    var end_comment = 0;

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
                        loadComment(0, 5, (result)  => {
                                end_comment = 0;
                                document.getElementById("comment_box").innerHTML = result;
                        });
                    } 
                    swal(data.message, "", data.code);
                }, 500);
            });
        }
    }


    function loadComment($start, $end, callb){
        end_comment += $end;
        $.get('{{YUH_URI_ROOT}}/product_comment/view/{{@Data:product->id}}/limit/'+$start+'/'+$end, callb);
    }

    const CMT_XT = "Xem thêm bình luận";
    const CMT_XTL = "<span class=\"spinner-border spinner-border-sm\"></span>Đang tải...";
    function xemThem(e){
        if(e.innerHTML == CMT_XTL) return;
        e.innerHTML = CMT_XTL;
        loadComment(end_comment, 5, (result)  => {
               e.innerHTML = CMT_XT;
               document.getElementById("comment_box").innerHTML += result;

               if(result == ""){
                    swal("Hết comment", "", "error");
               }
            });
    }

    loadComment(0, 5, (result)  => {
               end_comment = 0;
               document.getElementById("comment_box").innerHTML = result;
            });

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


    <div id = "comment_box">
        
    </div>
    <button class="btn btn-primary" onclick = "xemThem(this)">Xem thêm bình luận</button>

</div>
