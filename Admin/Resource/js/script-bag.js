/*
    -tập trung những sript xử lí túi hàng
*/

Bag = {};


/*
    - hàm này sẽ xử lí các thao ác khởi động
*/
Bag.init = function (){
    //lấy các dom
    Bag.DOM = toDomByIDAr([
        "giaSP", "giaVC", "giaTC", "cproduct", "bg-count"
    ])

    Bag.createList();
    
    //sản phẩm hot
    Bag.hotSale =document.getElementById("hot-sale");
    Bag.hotSale = new SlidesProduct(document.getElementById("hot-sale"), 250, 5);
    for( i in DATA_HOT_SALE){
        Bag.hotSale.container_child.innerHTML += getProductHTML(convertLinkToPath(DATA_HOT_SALE[i]), DATA_HOT_SALE[i]);
    }
    Bag.hotSale.init();
}

/*
    - hàm này dùng để thiết lập các thông tin giá tiền
    - @sp: giá thành tổng cộng sản phẩm
    - @sv: giá thàh vạn chuyển snr phẩm
*/
Bag.setupCoin = function (sp, vc){
    Bag.DOM.giaSP.innerHTML = convertCoin(sp)+"đ";
    Bag.DOM.giaVC.innerHTML = convertCoin(vc)+"đ";
    Bag.DOM.giaTC.innerHTML = convertCoin(vc+sp)+"đ";
}

Bag.createList = function (){
    var table = CBag.load();
    var vc = 100000;
    var sp = 0;
    var count = 0;
    var txt = "";
    for( var i in table){
        txt += Bag.createProduct(table[i].link, i);
        count++;
        var js = convertLinkToPath(table[i].link);
        if( js.sale ){
            sp += Math.round(js.coin*((100-js.sale)/100));
        } else {
            sp += Number(js.coin);
        }
    }
    if( txt == "" ){
        count = 0;
        txt = '<div class="bg-dl-child">Chưa có sản phẩm để thanh toán!</div>';
        sp = 0;
        vc = 0;
    }
    Bag.DOM["bg-count"].innerHTML = "("+count+" sản phẩm)"
    Bag.DOM.cproduct.innerHTML = txt;
    Bag.setupCoin(sp, vc);
}


/*
    - phân tích các sản phẩm
    -@img
    -@sale
    -@note
    -@name
    -@sub
    -@coin
*/
Bag.createProduct = function ( link, delid ){
    var js = convertLinkToPath(link);
    console.log(js);
    var html_link = "<a href=\"sanpham.php?q="+link+"\">";
    return `<div class="bg-product">
                    <div class="bg-img">
                            `+html_link+`
                                <img src="`+js.img+`">
                            </a>
                    </div>

                    <div class="bg-del">
                            <div class="bg-title">
                                `+html_link+js.name+`</a>
                            </div>
                            <div class="bg-support">
                                Được cung cấp bởi <u>SShop</u>
                            </div>
                            <div class="bg-button">
                                <button class="del" onclick="Bag.del(this, '`+delid+`')">Hủy Bỏ</button>
                            </div>
                    </div>

                    <div class="bg-coi">
                            <div class="bg-real">
                                `+(
                                js.sale?
                                    convertCoin(Math.round(js.coin*((100-js.sale)/100)))+"đ"
                                    :
                                    convertCoin(js.coin)+"đ"
                                )+`
                            </div>
                            <div class="bg-sale">
                                `+(
                                js.sale?
                                    convertCoin(js.coin)
                                    :
                                    ""
                                )+`
                            </div>
                            <div class="bg-ptsale">
                                <span>`
                                 +(js.sale?'-'+js.sale+'%':(js.note?js.note:'NORMAL'))+
                                 `</span>
                            </div>
                    </div>
                </div>`
}


Bag.del = function (e, id){
    e = e.parentNode.parentNode.parentNode;
    e.style.height = 0;
    e.style.padding = "0 15px";

    //xóa bỏ phần tử , và cập nhật lại
    setTimeout( function ( id ){
        CBag.remove(id);
        Bag.createList();
        CBag.updateHTML();
    }, 550, id);
}