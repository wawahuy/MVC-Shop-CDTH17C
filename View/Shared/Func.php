<?php 
    function JS_Call_When_Onload($object_js){
        echo '<script> window.onload = '.$object_js.'; </script>';
    }


    function JS_Set_Json($va, $obj){
        echo '<script> '.$va.' = JSON.stringify(\''.json_encode($obj).'\'); </script>';
    }

    function JS_SetVarNumber($name, $value){
        echo '<script> '.$name.' = '.$value.'; </script>';
    }


    function JS_Interval_Location($url, $time){
    ?>
    <script>
        setTimeout(() => {
            location.href = '<?php echo $url;?>';
        }, <?php echo $time;?>);
    </script>
<?php
    }


    function JS_Add_Fix_Page(){

    ?>
        <script>
        /*
            - đoạn code này áp dụng cho tấc cả các page của website
            - chức năng: thêm menu, thêm nút back to top
        */

		//cho menu luôn ở trên cùng
		window.addEventListener("load", function (){
            Header.init();
            //khởi tạo menu, thêm fixed cho menu luôn top, thêm nút di chuyển lên top
			Header.fixedBarMenu();
		}, false);

        //kiểm tra scroll
        addScroll = function ( event ){
            if( getScroll()>300 ) {
                Header.addBackTop();
                window.removeEventListener("scroll", addScroll , false);
                window.addEventListener("scroll", removeScroll , false);
            }
        }

        removeScroll = function ( event ){
            if( getScroll()<=300 ) {
                Header.removeBackTop();
                window.addEventListener("scroll", addScroll , false);
                window.removeEventListener("scroll", removeScroll , false);
            }
        }

        window.addEventListener("scroll", addScroll , false);
    </script>
    
<?php
    }
?>