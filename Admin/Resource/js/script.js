//phân giải các element khi được click có attr href-click=""
window.addEventListener( "click", HrefClick, false);
function HrefClick( e ){
    target = e.target;

    //check attr target
    attrTarget = "_self";
    if( target.hasAttribute("target") ) attrTarget = target.getAttribute("target");

    //kiểm tra sự tồn tại của href-click 
    if( target.hasAttribute("href-click") )
        window.open( target.getAttribute("href-click"), attrTarget );
}


/*
    - tiên hành phân giải têi miền
    - xử lí lấy các thuộc tính như $_GET trong php
*/
//bỏ kí tự ? ở đầu, de url sang text
//getSearch = decodeURI(window.location.search.substr(1, window.location.search.length));
getSearch = decodeURI(window.location.href.split(".php?")[1]);
//tách lấy các nhóm key=value
$_GET = splitKeyValue(getSearch);

function splitKeyValue( gs ){
    var gg = {};
    getKey = gs.split("&");
    for( i in getKey){
        //tách key và value
        sp = getKey[i].split("=");
        gg[ sp[0] ] = sp[1];
    }
    return gg;
}


/*xử lí phân giải POST*/
$_POST = {}
window.addEventListener('load', setTimeout.bind(null, $initPOST, 50), false);
function $initPOST(){

    //phân tích dự liệu của page trước đó
    if( CSDL.check('__POST__')) 
        try {
                $_POST = JSON.parse(decToText(CSDL.get('__POST__')));
        } catch (e){}

    //xóa bỏ dự liệu
    CSDL.set('__POST__', '');

    //cài đặt sự kiện lắng nghe submit có method post
    var f = document.getElementsByTagName("form");
    for( var i in f)
        try {
            //kiểm tra tính đúng đắng
            var g = f[i].getAttribute("method");
            if(!g) continue;
            if( g.toLocaleLowerCase()!="post" ) continue;

            //thêm sự kiện
            f[i].addEventListener('submit', function (e){
                
                    //xử lí khi nhấn submit
                    var dom = e.target;
                    var js_ = {};

                    //lấy các giá trị trong input
                    var inp = dom.getElementsByTagName("input");
                    for( var i in inp )
                        try {
                            js_[ inp[i].getAttribute('name') ] = inp[i].value;
                        } catch (e) {}
                    
                    //cập nhật dữ liệu
                    CSDL.set('__POST__', textToDec(JSON.stringify( js_)));
                    
            }, false);
        } catch (e){}
}





/*
    - Ẩn một đối tượng
*/
function Hide( el ){
    el.style.display = "none";
}


/*
    - scroll
*/
function setScroll( px ){
    document.body.scrollTop = px; 
    document.documentElement.scrollTop = px; 
}


/*
    - scroll get
*/
function getScroll( px ){
    var doc = document.documentElement;
    var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
    var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
    return top;
}

/*
*/
replaceAll = function(str, search, replacement) {
    var target = str;
    return target.replace(new RegExp(search, 'g'), replacement);
};

/*
    -chuyển đỗi văn bản -> cơ số 10
*/
function textToDec( text ){
    var c = "";
    for(i in text)
        c+= text[i].charCodeAt()+".";
    return c.substr(0, c.length-1);
}

/*
    -chuyển đổi cơ số 10->văn bản
*/
function decToText( dec ){
    var c = ""
    dec = dec.split(".");
    for(i in dec)
        c+=String.fromCharCode(dec[i]);
    return c;
}

/* - chuyễn 1 list dec to text
*/
function decToTextArr( decAr ){
    var out = {};
    for( var i in decAr)
        try {
            out[i] = decToText(decAr[i]);
        } catch(e){}
    return out;
}




/*
    - Object cookie cung cấp các hàm xử lí COOKIE
*/
Cookie = {};

/*
    - hàm này cho phép bạn thay đổi cookie
    - @cname: tên của cookie sẽ được thêm cvalue
    - @cvalue: giá trị cần gán, (TEXT)
    - @exdays: thời gian hết hạn của cookie, default: 365 ngày
*/
Cookie.set = function (cname, cvalue, exdays = 365) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}


/*
    - hàm này cho phép bạn lấy cookie
    - @cname: tên của cookie sẽ được lấy cvalue
*/
Cookie.get = function (cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}



/*
    - hàm này kiểm tra cookie
    - @cname: tên của cookie sẽ được lấy cvalue
*/
Cookie.check = function (cname) {
    if(Cookie.get(cname) == "") return false;
    return true;
}





/*
    - Lưu trữ Storage
*/
CSDL = {};

CSDL.set = function (sname, svalue){
    try {
        localStorage.setItem(sname, svalue);
    } catch (e){
        console.log(e);
    }
}

CSDL.get = function (sname){
    try {
        return localStorage.getItem(sname);
    } catch (e){
        console.log(e);
        return "";
    }
}

CSDL.check = function (sname){
    try {
        if( CSDL.get(sname)==null || CSDL.get(sname)=="" ) return false;
        return true;
    } catch (e){
        console.log(e);
        return false;
    }
}


/*
    - chuyển tấc cả dom id sang document
    - @_list_id: danh sách tên id cần gét DOM
*/
toDomByIDAr = function ( _list_id ){
    var dd = {};
    for( i in _list_id )
        dd[_list_id[i]] = document.getElementById(_list_id[i]);
    return dd;
}




// /*
//     - check user, login, register

// */
// CUser = {};
// CUser.NAMECSDL = "__user__";

// /*
//     - Load thông tin
// */
// CUser.load = function (){
//     //load dữ liệu -> chuyển số sang text -> json
//     try {
//         var a = CSDL.get(CUser.NAMECSDL);
//         var b = decToText(a);
//         return JSON.parse(b);
//     } catch (e){
//         console.log(e)
//         return [];
//     }
// }

// /*
//     -thêm trạng thái đăng nhập
// */
// CUser.Logged = function (pos){
//     CSDL.set('LOGGED', pos);
// }

// /*
//     -kiểm tra trạng thái đăng nhập
// */
// CUser.isLogged = function (){
//     if( CSDL.check('LOGGED') )
//         return CSDL.get('LOGGED');
//     else
//         return -1;
// }

// /*
//     -xóa trạng thái đăng nhập
// */
// CUser.Logout = function (){
//     CSDL.set('LOGGED', '');
// }


// /*
//     - kiểm tra sự tồn tại của email
//     - @email: địa chỉ email cần xác định
// */
// CUser.checkEmail = function ( em ){
//     //email cần kiểm tra
//     em = em.toLowerCase();
//     //load dữ liệu
//     var ctable = CUser.load();
//     //kiểm tra tấc cả
//     for(var i=0, len=ctable.length; i<len; i++){
//         if( ctable[i].email.toLowerCase() == em ) return i;
//     }
//     return -1;
// }


// /*
//     - kiểm tra đúng mật khẩu của user
//     - @posU: vị trí của user trong bảng
//     - pass: mật khẩu cần kiểm tra
// */
// CUser.checkPass = function ( posU, pass ){
//     var table = CUser.load();
//     if( table[posU].pass == pass ) return true;
//     return false;
// }


// /*
//     - thêm tài khỏa
//     - @deltail: json [fullname, pass, email, address, sdt, cmnd]
// */
// CUser.insertAccount = function ( deltail ){
//     var table = CUser.load();
//     table.push({
//         fullname: deltail.fullname,
//         address: deltail.address,
//         email: deltail.email,
//         pass: deltail.pass,
//         sdt: deltail.sdt,
//         cmnd: deltail.cmnd
//     });
//     CSDL.set(CUser.NAMECSDL, textToDec(JSON.stringify(table)));
// }


// /*  
//     - lấy tấc cả thông tin tài khoản
// */
// CUser.getAccount = function (pos){
//     try {
//         var table = CUser.load();
//         return table[pos];
//     } catch (e){
//         console.log(e);
//         return {};
//     }
// }



/*
    - effect khi scrolll
    - hidden-scroll là những class sẽ lấy
    - hidden-scroll[ten effect] là hiệu ứng sẽ được sử dụng, những hiệu ứng đang áp dụng
        + efScroll1: thực hiện scale và opacity
        
*/
var effectWhenScroll = {};

effectWhenScroll.init = function () {
        effectWhenScroll.elems = document.getElementsByClassName('hidden-scroll');
        effectWhenScroll.windowHeight = window.innerHeight;
        effectWhenScroll._addEventHandlers();
}

effectWhenScroll._addEventHandlers = function () {
        window.addEventListener('scroll', effectWhenScroll._checkPosition);
        window.addEventListener('load', effectWhenScroll._checkPosition);
        window.addEventListener('resize', effectWhenScroll.init);
}

effectWhenScroll._checkPosition = function () {
    for (var i = 0; i < effectWhenScroll.elems.length; i++) {
        var posFromTop = effectWhenScroll.elems[i].getBoundingClientRect().top;
        if (posFromTop -effectWhenScroll. windowHeight <= 0) {
                effectWhenScroll.elems[i].className = replaceAll(effectWhenScroll.elems[i].className, 'hidden-scroll', '')
        }
    }
}
window.addEventListener('load', effectWhenScroll.init, false);


function convertCoin(price) {
  const pieces = parseFloat(price).toFixed(2).split('')
  let ii = pieces.length - 3
  while ((ii-=3) > 0) {
    pieces.splice(ii, 0, ',')
  }
  return pieces.join('').substr(0, pieces.join('').length-3);
}


/*  lấy sản phẩm
    json phải bao gồm các thuocj tính
    @img
    @name
    @sale
    @note
    @coin
    @star
    @subname
*/
function getProductHTML( _js, link, sty="" ){
    //console.log(link);
    return    ` 
                <div class="pd-container" style="`+sty+`">
                    <div class="pd-look">
                        <div class="pd-image">
                            <img src="`+_js.img+`">
                        </div>
                        <div class="pd-sale"><span>`+(_js.sale?'-'+_js.sale+'%':(_js.note?_js.note:'NORMAL'))+`</span></div>
                        <div class="pd-deltail">
                            <div class="pd-title">
                                `+_js.name+`
                            </div>
                            <div class="pd-star-container noselect">
                                <span `+(_js.star>0?'class="yes-st"':'')+`></span>
                                <span `+(_js.star>1?'class="yes-st"':'')+`></span>
                                <span `+(_js.star>3?'class="yes-st"':'')+`></span>
                                <span `+(_js.star>3?'class="yes-st"':'')+`></span>
                                <span `+(_js.star>4?'class="yes-st"':'')+`></span>
                            </div>
                            <div class="pd-add-card noselect">
                                <div class="pd-button-view" onclick="AddToCard(this, '`+link+`')">
                                    <span>ADD</span>
                                </div>
                                <div class="pd-wait-add">
                                    <span></span>
                                </div>
                                <div class="pd-com-add">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pd-select">
                        <div class="pd-price">
                            `+(_js.sale?`
                            <span class="real">`+convertCoin(_js.coin)+"đ"+`</span>
                            <span class="sale">`+convertCoin(Math.round(_js.coin*((100-_js.sale)/100)))+"đ"+`</span>
                            `:
                            `
                            <span class="no-sale">`+convertCoin(_js.coin)+"đ"+`</span>
                            `)+
                            `
                        </div>
                        <div class="pd-view noselect" href-click='sanpham.php?path=`+link+`'></div>
                    </div>
                </div>
            `
}
