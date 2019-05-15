<?php
/**
 * Coder: Nguyễn Gia Huy
 * Bắt đầu: 10-04-2019
 * Hoạt động: 12-04-2019
 *          
 * 
 */
include_once dirname(__FILE__)."/../Config/Route.config.php";


define("ROUTE_ERR_VALUES", "route error value");
define("ROUTE_ERR_MATCH",  "route error match");



/**
 * Phân luồng hoạt động của các controller
 * Luôn bắt đầu bằng "/"
 * Hỗ trợ parmeters và constraint
 *      Params:         [name]
 *      Contrainst:     ["name" => "regexp"]
 * 
 * 
 */
class Route {

    /**
     * Kiểm tra xem có Route nào thông không
     * Được sử dụng bởi notraffic
     *
     * @var boolean
     */
    private static $hasRouting = false;


    /**
     * Accept all method, get, post,...
     * $process là string sẽ tự động truyền cho Func::Call_method_of_class_empty
     *
     * @param string $path
     * @param string|function $process
     * @return void
     */
    public static function all($path, $process){
        Route::get($path, $process);
        Route::post($path, $process);
    }


    /**
     * GET Method
     * $process là string sẽ tự động truyền cho Func::Call_method_of_class_empty
     * $path : dont use [] and :
     * 
     * @param string $path
     * @param string|function $process
     * @return void
     */
    public static function get($path, $process, $constraint=null) {
        #Only accept with GET
        if($_SERVER["REQUEST_METHOD"] == "GET") 
            Route::makeRouting($path, $process, $constraint);
    }

    
    /**
     * POST Method
     * $process là string sẽ tự động truyền cho Func::Call_method_of_class_empty
     *
     * @param string $path
     * @param string|function $process
     * @return void
     */
    public static function post($path, $process, $constraint=null){
        #Only accept with POST
        if($_SERVER["REQUEST_METHOD"] == "POST") 
            Route::makeRouting($path, $process, $constraint);
    }


    /**
     * Được gọi nếu từ đầu đến hiện tại chưa có route được khớp
     * $process là string sẽ tự động truyền cho Func::Call_method_of_class_empty
     *
     * @param function|string $process
     * @return void
     */
    public static function notraffic($path = null, $process, $constraint = null){
        if(!Route::$hasRouting)
            Route::makeRouting(preg_replace("/^".Route::quotePath(YUH_URI_ROOT)."/", "", $_SERVER["REQUEST_URI"]), $process, null);
    }


    /**
     * Chuyển hướng trang Path gốc là __DIR__/App.php
     *
     * @param string $path
     * @return void
     */
    public static function Redirect($path){
        Func::Redirect(YUH_URI_ROOT."/".preg_replace("/^\//", "", $path));
    }





    /**
     * Cấu hình router với json array thay vì dùng get|post|all 
     * $process là string sẽ tự động truyền cho Func::Call_method_of_class_empty
     *
     * Mỗi child có câu trúc bao gồm các thông tin sau:
     *      - "method"      : "get|post|all"
     *      - "path"        : "uri"
     *      - "process"     : function|string (callback($param) hoặc string controller)
     *      - ["constraint"]: array các rang buộc trên params
     * 
     * Ex:
     *  $route_config = [
     *      [
     *          "method"    =>   "get",
     *          "path"      =>   "/",
     *          "process"   =>   "Controller: Home@Index",
     *      ]
     *  ];
     * 
     * 
     * @param array $data
     * @return void
     */
    public static function config($route_config){
        foreach($route_config as $route){
            Route::{strtolower($route['method'])}($route['path'] ?? null, $route['process'], $route['constraint'] ?? null);
        }
    }




    /**
     * Xữ lí các Route
     *
     * @param string $path
     * @param function|string $process
     * @param array $constraint
     * @return void
     */
    private static function makeRouting($path, $process, $constraint){
        #Fix URI
        $uri = preg_replace('/\?(.*)$/', '', $_SERVER["REQUEST_URI"]);
        $path = YUH_URI_ROOT.$path;

        #Lấy các parameter trên path
        $params = Route::makeParameters($path, $uri, $constraint);

        #Match url
        if((($params == null && $uri!=$path) ||      //TH khi URI không chứa params & uri khác với path
             $params == ROUTE_ERR_VALUES ||          //TH khi URI không có values trên params
             $params == ROUTE_ERR_MATCH) &&          //TH khi URI không khớp values và params
             $path != YUH_URI_ROOT."*"               //TH khi chấp nhận tấc cả request
            )
            return;

        #Khi có luồng được thông, bật hasRouting và ngăn cảng callback bởi notraffic
        #Không chấp nhận luồn tấc cả
        if($path != YUH_URI_ROOT."*")    
            Route::$hasRouting = true;

        #Gọi process
        if(is_string($process)){
            Func::Call_method_of_class_empty($process, $params);
        }
        #gọi callback
        else {
            $process($params);
        }
    }



    /**
     * Phân giải các parameter
     *
     * @param string $path
     * @param string $uri
     * @param array $constraint
     * @return array|string
     *      null:               Không chứa parameters
     *      ROUTE_ERR_VALUES:   Trong URL không hợp lệ parameters phù hợp path
     *      ROUTE_ERR_MATCH:    Parameter và Values trên URL không đồng đều
     */
    private static function makeParameters($path, $uri, $constraint){
        $params = array();

        #tìm kiếm các parameters
        $paramsName = array();
        if(!preg_match_all("/\[([\w|\d|_]+)\]/", $path, $paramsName)) return null;
        $paramsName = $paramsName[1]; // 0 - group , 1 - matches

        #quote path
        $path = Route::quotePath($path);

        #thay thế constraint và param tương ứng
        foreach($paramsName as $param){
            $pattern = "/\[{$param}\]/";
            $str_const = isset($constraint[$param]) ? $constraint[$param] : ".*";
            $str_const = "({$str_const})";
            $path = preg_replace($pattern, $str_const, $path);
        }

        #tim giá trị
        $values = array();
        $pattern = "/".$path."/";
        if(!preg_match_all($pattern, $uri, $values)) return ROUTE_ERR_VALUES;
        $values = Route::filterValuesParams($values);

        if(count(array_keys($paramsName)) != count(array_keys($values)))
            return ROUTE_ERR_MATCH;

        #gáp params và value
        foreach ($paramsName as $key => $value) {
            $params[$value] = $values[$key];
        }

        return $params;
    }



    /**
     * RegXP đương dẫn
     *
     * @param [type] $path
     * @return void
     */
    private static function quotePath($path){
        foreach(str_split("*.?+^|{}:/()") as $q){
            $path = preg_replace("/\\{$q}/", "\\{$q}", $path);   
        }
        return $path;
    }


    /**
     * Lọc các values hợp lệ trên parameter
     *
     * @param array $cpvl
     * @return array
     */
    private static function filterValuesParams($cpvl){
        $values = array();
        foreach ($cpvl as $value) {
            if(!preg_match("/\//", $value[0])) array_push($values, $value[0]);
        }
        return $values;
    }


    /**
     * Sửa lỗi phân đương dẫn Window
     * Phân biệc hoa thường
     * 
     */
    public static function fixPathWindows(){
        $request_uri = substr($_SERVER['REQUEST_URI'], 0, strlen(YUH_URI_ROOT));
        if(!preg_match('/'.Route::quotePath($request_uri).'/', $_SERVER["SCRIPT_FILENAME"])){
            echo 'Lỗi đường dẫn Window, chú ý phân biệc hoa thường!<br>';
            exit();
        }
    }


    /**
     * Trở về page trước đó
     *
     * @return void
     */
    public static function back_referer(){
        Func::Redirect($_SERVER["HTTP_REFERER"]);
    }


    public static function getReferer(){
        return $_SERVER["HTTP_REFERER"];
    }

}



?>