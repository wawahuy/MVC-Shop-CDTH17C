<?php

/**
 * Coder: Nguyễn Gia Huy
 * Bắt đầu: 01-04-2019
 * 
 * 
 */

/**
 * Thực hiện các đoạn mã Javascript
 * Chạy:
 *      Javascript::Run()
 */
class Javascript {

    /**
     * Chứa tấc cả code được thực hiện
     *
     * @var string
     */
    private static $code = "";


    /**
     * Thực hiện những thao tác được gọi trước đó
     *
     * @param string $code
     * @return void
     */
    public static function Run($code = null){
        $code = isset($code) ? $code :  Javascript::$code;
        echo "<script>".$code."</script>";
    }


    /**
     * Xóa hết code javascript trong bộ đệm
     *
     * @return void
     */
    public static function Clear(){
        Javascript::$code = "";
    }


    /**
     * Chèn thêm code javascript
     *
     * @param string $script
     * @return void
     */
    public static function InvokeScript($script){
        Javascript::$code .= $script."\r\n";
    }


    /**
     * Gọi code javascript vừa chèn trong khoản thời gian ngủ
     *
     * @param string $script
     * @param int $time
     * @return void
     */
    public static function InvokeScriptTimeout($script, $time){
        Javascript::InvokeScript(
            "setTimeout(function (){ {$script} }, {$time});"
        );
    }


    /**
     * Chuyển hướng trang sau một khaonr thời gian
     *
     * @param string $link
     * @param int $time
     * @return void
     */
    public static function InvokeRedirect($link, $time){
        Javascript::InvokeScriptTimeout("location.href = '{$link}';", $time);
    }


    /**
     * Chèn Alert vào code
     *
     * @param string $title
     * @param string $content
     * @param string $status
     * @return void
     */
    public static function InvokeSwal($title, $content, $status){
        Javascript::InvokeScript(Javascript::StrSwal($title, $content, $status));
    }



    /**
     * Tạo code alert
     *
     * @param string $title
     * @param string $content
     * @param string $status
     * @return void
     */
    public static function StrSwal($title, $content, $status){
       return "swal('{$title}', '{$content}', '{$status}');";
    }

}



?>