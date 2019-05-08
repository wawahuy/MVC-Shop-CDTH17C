
/*  class sử lí product slides
    - container: DOM chứa
    - width: kich thuoc cua pd-container (product)
    - padding: padding
*/
SlidesProduct = function ( container, width, padding ){
    this.container_view = container;
    this.container_child = this.container_view.getElementsByClassName("pd-slides-container")[0]
    //thông số ban đầu
    this.width = width;
    this.padding = padding;
    this.cur_translate = 0;
}    

SlidesProduct.prototype.init = function (){
    try {
    //lấy container chid
    this.child = this.container_child.getElementsByClassName("pd-container");
    this.lenchild = this.child.length;

    //tính toán  chiều rộng toàn slides
    this.max_width = (this.width+this.padding*2)*this.lenchild;

    //cập nhật chiều rộng toàn slide
    this.container_child.style.width = this.max_width+"px";

    //lấy kích thước khung view => đây là kích thước translate thêm
    this.width_view =  this.container_view.clientWidth;

    //thêm các sự kiện ấn tới lui
    this.btL = this.container_view.getElementsByClassName("btL")[0];
    this.btR = this.container_view.getElementsByClassName("btR")[0];
    this.btL.addEventListener("click", this.clickLeft.bind(this) , false);
    this.btR.addEventListener("click", this.clickRight.bind(this) , false);

    //kiểm tra hide bt
    this.checkButtonHidden();
    } catch (e){}
}

SlidesProduct.prototype.clickLeft = function (){
    if(this.cur_translate>0){
         this.cur_translate -= this.width_view;
         if(this.cur_translate<0) this.cur_translate = 0;
    }
    this.updateTranslate();
    this.checkButtonHidden();
}


SlidesProduct.prototype.clickRight = function (){
    if(this.cur_translate+this.width_view<this.max_width-30){
        this.cur_translate += this.width_view;
        if( this.cur_translate > this.max_width-this.width-30 ) this.cur_translate = this.max_width-this.width_view;
    }
    this.updateTranslate();
    this.checkButtonHidden();   
}


SlidesProduct.prototype.checkButtonHidden = function (){
    this.btL.style.display = "block";
    this.btR.style.display = "block";
    if(this.cur_translate<=0) this.btL.style.display = "none";
    if(this.cur_translate+this.width_view>=this.max_width-30) this.btR.style.display = "none";
}


SlidesProduct.prototype.updateTranslate = function (){
    this.container_child.style.transform = "translateX(-"+this.cur_translate+"px)";
}




/* 
    -sự kiện khi * được nhấn
    -sau khi load, một sự kiện sẽ lắng nghe tấc ca các click star
*/
window.addEventListener("load", 
    setTimeout.bind(null, function (){
            container_stars = document.getElementsByClassName("pd-star-container");
            for( l=0; l<container_stars.length; l++){
                container_star = container_stars[l].getElementsByTagName("span");
                for(i=0; i<5; i++)
                    container_star[i].addEventListener("click", clickContainerStar.bind(null, container_star, i), false );
            }
    }, 200)
    , false);

clickContainerStar = function (container_star,pos){
    for(i=0; i<5; i++)
        container_star[i].className = (i<=pos?'yes-st':'no-st');
}



/*
    - Hiệu ứng phân tích Link ra JSon
    @link: là liên kết đến sản phẩm

*/
function convertLinkToPath( link ){
    var splnk = link.split("/");
    var len = splnk.length-2;
    var subname = splnk[len];
    var name = splnk[len+1];

    //lấy path /*JSON.parse(JSON.stringify(DATA))*/
    var js = DATA;
    for( var i=0; i<len; i++) js = js[splnk[i]];

    //lọc
    for( var i in js)
        if( js[i].subname == subname && js[i].name == name) return js[i];
        
    return false;
}


/*
    - hàm thêm sản phẩm
    -
*/
function AddToCard( e, link){
    //kiểm tra disable
    var t = new Date().getTime();
    dom = e.parentNode.getElementsByTagName("div");
    if( ts = dom[0].getAttribute("time") )
        if( t - ts < 4000) return;

    UpdateAddCard(e.parentNode.parentNode.parentNode, true);
    setTimeout( UpdateAddCard, 4000, e.parentNode.parentNode.parentNode, false);
    setTimeout( CBag.updateHTML, 3600);
    setTimeout( effAddCard, 1400+i*50, e);

    for(i=0; i<dom.length; i++){

        //thêm hiệu ứng
        dom[i].classList.remove("pd-click");
        void dom[i].offsetWidth;
        dom[i].classList.add("pd-click");
        dom[i].setAttribute("time", t);
    }

    setTimeout( function (){
        //lưu thông tin 
        CBag.insert( {
            link: link
        } )
    }, 3550);
}

/*lưu giữ trạng tháy hover product khi mouse out
    .pd-image: (.hv-image)
    .pd-deltail: (.hv-deltail)
    .pd-title: (.hv-title)
    .pd-star-container: (.hv-star)
    .pd-add-card: (.hv-add)
*/
hoverCName = [
    { 
      before: "pd-image",
      after: "hv-image"
    },
    { 
      before: "pd-deltail",
      after: "hv-deltail"
    },
    { 
      before: "pd-title",
      after: "hv-title"
    },
    { 
      before: "pd-star-container",
      after: "hv-star"
    },
    { 
      before: "pd-add-card",
      after: "hv-add"
    }
];    

function UpdateAddCard( _d, key ){
    for( i in hoverCName){
        var _i = _d.getElementsByClassName(hoverCName[i].before)[0];
        if( key )
            _i.classList.add( hoverCName[i].after );
        else 
            _i.classList.remove( hoverCName[i].after );
    }
}


/*hiệu ứng thêm sản phẩm*/
function effAddCard( e ){
    var rect = e.getBoundingClientRect();
    var y = rect.top+25;
    var x = rect.left+50;

    //tạo element dịch chuyển
    var ele = document.createElement("span");
    ele.className = "tuiHang-add";
    ele.style.display = "block";
    ele.style.top = y+"px";
    ele.style.left = x+"px";
    ele.style.opacity = 0;
    void ele.offsetWidth;
    CBag.dAdd.appendChild( ele );

    //dịch chuyển bag lên
    setTimeout(function (e, ele){
        var rect = e.getBoundingClientRect();
        var y = rect.top+25;
        var x = rect.left+50;
        ele.style.opacity = 1;
        ele.style.top = (y-50)+"px";
        ele.style.left = x+"px";
    }, 10, e, ele);

    //di chuyển bag
    setTimeout(function (ele){
        ele.classList.add("efAddBag");
    }, 1000, ele);

    //xoa di chuyển bag
    setTimeout(function (ele){
        CBag.dAdd.removeChild(ele);
    }, 2200, ele);
}




/*
    -Object Bag chứa các hàm lưu trữ add to card của người dùng
    - getBag() : trả về json 
    - insertBag()
    - deleteBag( id )
*/
CBag = {}
CBag.NAMECSDL = "__BAG__";

CBag.init = function (){
    CBag.dTui = document.getElementById("tuiHang");
    CBag.dDem = document.getElementById("tuiHang-count");
    CBag.dAdd = document.body;
    //CBag.updateHTML();
}
window.addEventListener( "load", CBag.init, false);

/*
    - Load thông tin
*/
CBag.load = function (){
    //load dữ liệu -> chuyển số sang text -> json
    try {
        var a = CSDL.get(CBag.NAMECSDL);
        var b = decToText(a);
        return JSON.parse(b);
    } catch (e){
        console.log(e)
        return {};
    }
}


CBag.insert = function ( _js ){
    var data = CBag.load();
    data[new Date().getTime()] = _js;
    CSDL.set(CBag.NAMECSDL, textToDec(JSON.stringify(data)));
}

CBag.remove = function ( id ){
    var data = CBag.load();
    delete data[id];
    CSDL.set(CBag.NAMECSDL, textToDec(JSON.stringify(data)));
}

CBag.count = function ( _js ){
    var data = CBag.load();
    var count = 0;
    for( var i in data) count++;
    return count;
}

CBag.updateHTML = function (){
    //đổi số lượng
    CBag.dDem.innerHTML = CBag.count();
    //thay đổi sản phẩm trong tui hàng
    var data = CBag.load();
    var txt = "";
    for( i in data ){
        /*console.log( convertLinkToPath( data[i].link ) );*/
        var dt = convertLinkToPath(data[i].link);
        txt += `<a href="sanpham.php?q=`+data[i].link+`">
                <div class="tH-child">
                    <div class="tH-sale"><span>`+(dt.sale?'-'+dt.sale+'%':(dt.note?dt.note:'NORMAL'))+`</span></div>
                    <div class="tH-img">
                        <img src="`+dt.img+`">
                    </div>
                    <div class="tH-del">
                        <div class="tH-name">
                            `+dt.name+`
                        </div>
                        <div class="tH-coin">
                            `+(
                                dt.sale
                                    ?"<span class=\"real\">"+convertCoin(dt.coin)+"đ</span><span class=\"sale\">"+
                                        convertCoin(Math.round(dt.coin*((100-dt.sale)/100)))+"đ"
                                    +"</span>"
                                    :convertCoin(dt.coin)+"đ"
                            )+`
                        </div>
                    </div>
                </div></a>`;
    }
    if( txt == ""){
         CBag.dTui.innerHTML = "<div class=\"bag-empty\">Empty Bag!</div>";
         return;
    }
    CBag.dTui.innerHTML = `
            <div class="tH-container">`+txt+`</div>
            <div class="tH-show">
                <a href="bag.php">Xem tấc cả (`+CBag.count()+`) sản phẩm</a>
            </div>
        `
}