//class header
Header = {};

//khởi tạo home
Header.init = function (){
    //ID Header
    Header.header = document.getElementById("header-home");
    Header.headertop = document.getElementById("header-top");
    Header.search = document.getElementById("search");
    Header.menu   = document.getElementById("menu-header");
    Header.backTop  = document.getElementById("backTop");
    Header.headeruser  = document.getElementById("header-user");
    Header.height = 0;
    //thêm chuyên mục menu
    //Header.createMenu( DATA );
    //thêm sự kiện hover button search
    Header.initSearch();
    //kiểm tra trạng thái đăng nhập
    //Header.checkUserLogin();
}

//sự kiện với khung search
Header.initSearch = function (){
    //khi hoverr
    Header.search.addEventListener("mouseover", 
        function (){
            document.getElementById("text-search").focus();
        }, false);
    //khi out mà ko ghi
    Header.search.addEventListener("mouseout", 
        function (){
            if(document.getElementById("text-search").value=="")
                document.getElementById("text-search").blur();
        }, false);
}


//cập nhật chiều cao của header
Header.setHeight = function (height){
    Header.height = height/2;
    Header.header.style.height = (height+3)+"px";
}



// /* 
//     - thêm chuyên mục menu
//     - @_json: chuyền vào một json , và nói chung là chuyenf vào DATA biến tập chung dữ liệu
// */
// Header.createMenu = function ( _json ){
//     for( i in _json ){
//         element_menu = document.createElement("li");
//         element_menu.setAttribute("href-click", "chuyenmuc.html?path="+i);
//         //tạo danh sách sub
//         sub_menu = "";
//         if( _json[i] instanceof Object && !(_json[i] instanceof Array))
//             sub_menu = Header.createSubMenu( _json[i], i);
//         element_menu.innerHTML = i+sub_menu;
//         Header.menu.appendChild( element_menu );
//     }
// }

// /* 
//     - thêm submenu cho chuyên mục
//     - bằng cách gọi đệ quy, sẽ giúp cho việt tạo code html, cập nhật chuyên mục tập trung nhanh chóng
//     - @_jssub: được chuyền vào một cấu trúc con từ _json[ i ]... _json[ i ][ k ]
//     _ link: đường dẫn đến chuyên mục , theo nguyên tắc parent/child, vd: chuyenmuc.html?path=Nam/Áo/Áo%20Thun
// */
// Header.createSubMenu = function ( _jssub, link ){
//     var cod = "<ul class=\"sub\">";
//     for( k in _jssub ){
//         cod += "<li href-click=\"chuyenmuc.html?path="+link+"/"+k+"\">"+k;
//         //tạo danh sách sub
//         var sub = "";
//         if( _jssub[k] instanceof Object && !(_jssub[k] instanceof Array) )
//             sub = Header.createSubMenu( _jssub[k], link+"/"+k );
//         cod += sub+"</li>";
//     }
//     cod += "</ul>"
//     return cod;
// }


/*
    -thêm xử lí sự kiện khi lướt hết header
    -@cb: hàm sẽ được gọi khi scroll đến bottom
*/
Header.addScrollBottom = function ( cb ){
    Header.callbackBottom = cb;
    window.addEventListener('scroll', Header.cb_bottom , false);
}
Header.removeScrollBottom = function ( cb ){
    Header.callbackBottom = cb;
    window.removeEventListener('scroll', Header.cb_bottom , false);
}

Header.cb_bottom = function( event ){
    if( getScroll() > Header.height ) Header.callbackBottom();
}


/*
    - ẩn slides, và cho bar menu lên top
*/
Header.relativeHeader = function (){
    //header cho vị trí phụ thuộc vào nó
    Header.header.className = "header-home-rel";
    //thiêt lặp khoản trống về 0
    Header.setHeight( Header.height );
}

/*
    - cho menu về đúng chổ của nó
*/
Header.absoluteHeader = function (){
    //header cho vị trí phụ thuộc vào nó
    Header.header.className = "header-home-abs";
    //thiêt lặp khoản trống về 0
    Header.setHeight( Header.height*4 );
}


/*
    - cho bar menu ở trên cùng
*/
Header.fixedBarMenu = function (){
    Header.headertop.className = "header-top-fix";
    //update các thuộc tính giống như khhi được hover
    Header.headertop.classList.add("bgwhite");
}


/*
    - cho bar menu ở cùng header
*/
Header.absoluteBarMenu = function (){
    setTimeout( function (){
        Header.headertop.className = "header-top-abs";
        //update các thuộc tính giống như khhi được hover
        Header.headertop.classList.remove("bgwhite");
        Header.headertop.style = "";
    }, 400);
    Header.headertop.style = "animation: aimHeaderBack 0.5s";
}

/*
    - back to top
*/
Header.addBackTop = function (){
    Header.backTop.style.display = "block";
    Header.backTop.addEventListener( "click", Header.backTopClick, false);
}

Header.removeBackTop = function (){
    Header.backTop.style.display = "none";
    Header.backTop.removeEventListener( "click", Header.backTopClick, false);
}

Header.backTopClick = function (){
    itop = getScroll();
    t=0;
    for(i=itop; i>0; i-=10)
        setTimeout(setScroll, t+=2, i);
}

// /*
//     - kiểm tra trạng tháy đăng nhập
// */
// Header.checkUserLogin = function (){
//     //kiểm tra user login
//     if( (pos=CUser.isLogged()) != -1 ){
//         var deltail = CUser.getAccount(pos);
//         Header.headeruser.innerHTML = `
//             <div class="account">
//                 <div class="acc-name">
//                     <span>`
//                     +deltail.fullname+
//                 `   </span>
//                     <div></div>
//                 </div>
//                 <div class="acc-avatar">
//                     <a href="profile.html"><img src="img/account.png"></a>
//                 </div>
//                 <div class="acc-menu">
//                     <div class="menu-container">
//                         <div href-click="profile.html">Hồ sơ</div>
//                         <div href-click="login.html?do=logout">Đăng xuất</div>
//                     </div>
//                 </div>
//             </div>`;
//     }
// }