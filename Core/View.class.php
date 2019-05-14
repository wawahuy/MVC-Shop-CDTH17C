<?php

/**
 * Coder: Nguyễn Gia Huy
 * Bắt đầu: 12-04-2019
 * 
 * View hỗ trợ loại bỏ code php ra khỏi phần View/
 * View hỗ trợ truyền data dễ dàng hơn
 * Version PHP: >=7.3.1
 * Hỗ trợ mẫu (Code Template)
 * Khi sử dụng mẫu cần xuống dòng đúng quy định
 * CODE:
 *    - Mẫu: luôn phân biệt hoa thường
 *    - Loại: 
 *      #include & require
 *          - PHP: <?php include|require '...'; ?>
 *          - Mẫu:  @include|require "..."
 *          * Trong mẫu:
 *              + @include sẽ đệ quy đọc lại các file (không chứa biến) và lắp đầy nó 
 *              + @require được chuyển sang lệnh require trên PHP
 *          * Sử dụng {{$VIEW_DIR}} là thư mục Root View
 *          * Sử dụng {{$URI_ROOT}} là thư mục Root Project
 *          * Khi sử dụng mẫu @include (Path là string duy nhất không chứa đk | biến) sẽ tự động bắt đầu bằng dirname(__FILE__)
 * 
 *      #Biến
 *          - PHP: <?=VAR_NAME;?>
 *          - Mẫu:  {{VAR_NAME}}
 * 
 *      #if...else
 *          - PHP: <?php if(st1){ r1 } else { r2 } ?>
 *          - Mẫu:
 *                  @if st1
 *                      r1
 *                  @else
 *                      r2
 *                  @endif
 * 
 *      #foreach
 *          - PHP:  <?php foreach( $a as $i ) { .... }
 *          - Mẫu:
 *                  @foreach $a as $i
 *                      ....
 *                  @endforeach      
 * 
 *      #call
 *          - PHP:  <?php .......; ?>
 *          - Mẫu:  @call .......            
 *                 
 * 
 *      #Sử dụng biến dữ liệu
 *          - PHP:  View::$DATA['name']
 *          - Mẫu:  @Data:name
 * 
 * 
 */
class View {

    /**
     * Lưu trữ các dữ liệu bind đến view
     * Sử dụng trên View có 2 cách
     *      C1:    View::$DATA[name]
     *      C2:    @Data:name
     * Để hiển thị giá trị cần đặt nó trong {{ ... }}, trong các lệnh khác có thể giữ bình thường
     *
     * @var array
     */
    public static $DATA = array();



    public static function general_code($path, array $data){
        $old_data = View::$DATA;
        View::$DATA = $data;
        return View::get_render_content($path);
        View::$DATA = $old_data;
    }



    /**
     * Bind data đến view
     *
     * @param string $name
     * @param object $value
     * @return void
     */
    public static function bind_data($name, $value){
        View::$DATA[$name] = $value;
    }



    /**
     * Render view với đường dẫn
     *
     * @param string $path
     * @return void
     */
    public static function render($path){
        $code = View::get_code_compile($path);

        //run code
        try {
            //COde debug
            eval('?>'.$code);
        } 
        catch (Exception $e){
            //Error message
            echo '<pre style="margin-top: 100px;">'.$e.'</pre>';

            //COde debug
            $i = 0;

            echo '<pre>'.preg_replace_callback('/(?P<cnt>.*)(?P<line>[\r\n])/', function ($m){
                global $i;
                return '<b>'.$i++.'</b> '.htmlspecialchars($m['cnt']).$m['line'];
            }, $code).'</pre>';
        }
    }



    /**
     * Lấy nội dung sau khi đã xữ lí mẫu và thực thi php
     *
     * @param string $path
     * @return void
     */
    public static function get_render_content($path){
        //run code
        ob_start();
        View::render($path);
        return ob_get_clean();
    }




    public static function get_code_compile($path){
        $code = View::read_all_code($path);

        //Xữ lí các mẫu
        $code = View::_require($code);
        $code = View::_call($code);
        $code = View::_var($code);
        $code = View::_foreach($code);
        $code = View::_if($code);
        $code = View::_change_var_data($code);
        $code = View::_eval($code);
        return $code;
    }




    /**
     * Đọc file với tấc cả 'include'
     *
     * @param string $path
     * @return string
     */
    private static function read_all_code($path){
        //$path = preg_replace('/\/([^\/]*)\/..\//', '/', $path);
        $rootPath = preg_replace('/([^(\/|\\)]*)$/', '', $path);
        $code = file_get_contents($path);

        //Chuyển include mẫu sang  include php
        $code = View::_include($code);

        //Lắp đầy include bởi nội dung của nó
        $code = preg_replace_callback('/<\?php(?P<php>.*)\?>/s', function ($m) use ($rootPath){
            return "\n<?php \n".preg_replace_callback('/include\s*[\'\"]{1}(?P<path>[^(\'\")]+)[\'\"]{1}\s*;/s', function ($m) use ($rootPath){
                $path = $rootPath.$m['path'];
                return "\n ?>\n".View::read_all_code($path)."\n <?php \n";
            }, $m['php'])." ?>\n";
        }, $code);

        return $code;        
    }



    /**
     * Đổi các biến mẫu tài nguyên
     *
     * @param string $code
     * @return string
     */
    private static function _change_var_data($code){
        return preg_replace_callback('/\s*@(?:Data|DATA):(?P<var>[\d|\w_]+)\s*/',  function($m){
            return ' View::$DATA[\''.$m['var'].'\'] ';
        }, $code);
    }



    /**
     * Include
     *
     * @param string $code
     * @return string
     */
    private static function _include($code){
        return preg_replace_callback('/(?:\s*|\r\n|^)@include\s+(?P<file>.+)\s*/',  function($m){
            return "\n<?php include ".$m['file'].";?>\n";
        }, $code);
    }



    /**
     * Require
     *
     * @param string $code
     * @return string
     */
    private static function _require($code){
        return preg_replace_callback('/(?:\s*|\r\n|^)@require\s+(?P<file>.+)\s*/',  function($m){
            return "\n<?php require ".$m['file'].";?>\n";
        }, $code);
    }


    /**
     * Eval
     *
     * @param string $code
     * @return string
     */
    private static function _eval($code){
        return preg_replace_callback('/(?:\s*|\r\n|^)@eval\s+(?P<code>[^\s\r\n]+)/',  function($m){
            $c = "";
            eval('$c = '.$m['code'].';');
            return "\n $c \n";
        }, $code);
    }



    /**
     * Call
     *
     * @param string $code
     * @return string
     */
    private static function _call($code){
        return preg_replace_callback('/(?:\s*|\r\n|^)@call\s+(?P<code>.*)\s*/',  function($m){
            return "\n<?php ".$m['code'].";?>\n";
        }, $code);
    }



    /**
     * Tiến hành chuyển các biến sang dạng php
     * {{var}} -> <?=var;?>
     *
     * @param string $code
     * @return string
     */ 
    private static function _var($code){
        return preg_replace_callback('/(\{\s*\{\s*(?P<var>[^\{\}]+)\s*\}\s*\})/',  function($m){
            return '<?='.$m['var'].';?>';
        }, $code);
    }




    /**
     * Tiến hành chuyển foreach sang php
     *
     * @param string $code
     * @return void
     */
    private static function _foreach($code){
        $pattern = '/@foreach(?P<main>((?!@foreach).)+?)@endforeach/s';
        while(preg_match('/@foreach\s+(.*)\s+as/', $code)){
            $code = preg_replace_callback($pattern,  function($m){
                return View::_foreach_split($m['main']);
            }, $code);
        }
        return $code;
    }

    private static function _foreach_split($code){
        $pattern = '/^\s*(?P<var_container>.+?)\s+as\s+(?P<var_child>\$[\w|\d_]+)(?P<container>.*)/s';
        return preg_replace_callback($pattern,  function($m){
            $var_container = $m['var_container'];
            $var_child = $m['var_child'];
            $container = $m['container'];
            return 
                "<?php foreach( $var_container as $var_child ){ ?> $container <?php } ?>";
        }, $code);
    }


    /**
     * Tiến hành chuyển if sang php
     *
     * @param string $code
     * @return string
     */
    private static function _if($code){
        $pattern = '/@if(?P<ifmain>((?!@if).)+?)(@else(?P<ifelse>((?!@if).)+?))?@endif/s';
        while(preg_match('/@if\s+(.*)\s*[\r\n]+/', $code))
            $code = preg_replace_callback($pattern,  function($m){
                $if_main = $m['ifmain'];
                if(!isset($m['ifelse']))
                    return View::_if_split($if_main)." <?php } ?>";
                else 
                    return View::_if_split($if_main)." <?php } else { ?>".$m['ifelse']."<?php } ?>";
            }, $code);
        return $code;
    }


    private static function _if_split($code){
        $pattern = '/^(?P<if>.+?)[\r\n]+(?P<container>.*)$/s';
        return preg_replace_callback($pattern,  function($m){
            $if = $m['if'];
            $container = $m['container'];
            return 
                "<?php if ( $if ){ ?> $container";
        }, $code);
    }
    

}
?>