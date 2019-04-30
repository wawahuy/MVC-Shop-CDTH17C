SSp = {};

SSp.init = function (){
    SSp.DOM = toDomByIDAr([
        "sppath", "tangSL", 'spcon',
        "sp-del-img", "sp-del-name", "sp-del-sale", "sp-del-star", "sp-pl"
    ]);

    //sự kiên khi thay đổi số lượng
    SSp.DOM.tangSL.addEventListener("change", SSp.soLg.bind(null, 0), false);

    //sản phẩm hot
    SSp.hotSale =document.getElementById("hot-sale");
    SSp.hotSale = new SlidesProduct(document.getElementById("hot-sale"), 250, 5);
    // for( i in DATA_HOT_SALE){
    //     SSp.hotSale.container_child.innerHTML += getProductHTML(convertLinkToPath(DATA_HOT_SALE[i]), DATA_HOT_SALE[i]);
    // }
    //
     SSp.hotSale.init();

    /*phân tích path*/
    // if(!$_GET['path'])
    //     if($_GET['q']) $_GET['path']=$_GET['q'];
    //     else $_GET['path'] = '';
    // var spl = $_GET['path'].split("/");
    // var lnk = ".html?path=";
    // var txt = "";
    // for( var i=0; i<spl.length; i++){
    //     lnk += spl[i];
    //     if(i==spl.length-2){
    //         lnk+='/';
    //         continue;
    //     }
    //     txt += `
    //         <span>
    //             <a href="`+
    //                 (i==spl.length-1?'sanpham':'chuyenmuc')+lnk
    //             +`">`+spl[i]+`</a>
    //         </span>
    //     `;
    //     lnk += "/";
    // }
    // SSp.DOM.sppath.innerHTML += txt;
    
    /*phân tích sản phẩm*/
    // var js = convertLinkToPath($_GET['path']);
    // if(!js){
    //     SSp.DOM.spcon.innerHTML = `
    //         <div class="sp-error">
    //             <div class="title">Sản phẩm không tồn tại!</div>
    //             <div class="help">
    //                 Bạn có thể tìm kiếm sản phầm khác ở 
    //                 [<a href="chuyenmuc.html"><b>Chuyên Mục</b></a>]!
    //             </div>
    //         </div>
    //     `
    //     return;
    // }

    // SSp.DOM['sp-del-img'].src = js.img;
    // SSp.DOM['sp-del-name'].innerHTML = js.name;

    //tiền
    // SSp.DOM['sp-del-sale'].innerHTML = `
    //     <div>`+(js.sale?convertCoin(Math.round(js.coin*((100-js.sale)/100)))+"đ":convertCoin(js.coin)+"đ")+`</div>`
    //     +(js.sale?`
    //         <div>`+convertCoin(js.coin)+"đ"+`</div>
    //         <div>-`+js.sale+`%</div>
    //     `:'');
    // ;

    // SSp.DOM['sp-del-star'].innerHTML = `
    //                             <span `+(js.star>0?'class="yes-st"':'')+`></span>
    //                             <span `+(js.star>1?'class="yes-st"':'')+`></span>
    //                             <span `+(js.star>3?'class="yes-st"':'')+`></span>
    //                             <span `+(js.star>3?'class="yes-st"':'')+`></span>
    //                             <span `+(js.star>4?'class="yes-st"':'')+`></span>
    // `;


    SSp.CreateOption();
}

/*
    - kiểm tra số lượng
*/
SSp.soLg = function (e){
    if( !Number(SSp.DOM.tangSL.value) )
        SSp.DOM.tangSL.value = 1;
    SSp.DOM.tangSL.value = Number(SSp.DOM.tangSL.value)+e;
    if( SSp.DOM.tangSL.value < 1  )
        SSp.DOM.tangSL.value = 1;
    if( SSp.DOM.tangSL.value > YUH_MAX_PRODUCT  )
        SSp.DOM.tangSL.value = YUH_MAX_PRODUCT;        
}


/*
    - khi thay đổi chọn lựa
*/
SSp.CreateOption = function (e){
    //sự kiện khi thay đổi phân loại
    SSp.DOM['sp-pl'].addEventListener("click", SSp.changPL, false);
}


SSp.changPL = function (e){
    if(e.target.nodeName!="BUTTON") return;
    var pr = e.target.parentNode.getElementsByTagName("button");
    for(var i in  pr)
        try { 
            pr[i].removeAttribute("class");
        } catch (ex){}
    e.target.setAttribute("class", "select");
    
    tag_name = e.target.parentNode.parentNode.getElementsByTagName("span")[0].innerHTML;
    js = JSON.parse(document.getElementsByName("option")[0].value);
    js[tag_name.substr(0, tag_name.length-2)] = e.target.innerHTML;
    document.getElementsByName("option")[0].value = JSON.stringify(js);
}


SSp.add = function (){
    /*thêm sản phẩm*/
    // CBag.insert(
    //     {
    //         link: $_GET['path']
    //     }
    // )
    //CBag.updateHTML();
    
    //Kiểm tra đã chon trong phân loại chưa
    opt = document.getElementsByName("option")[0];
    opt = JSON.parse(opt.value);
    for( key in opt){
        if(opt[key] == ""){
            swal("Lỗi", "Bạn cần chọn đầy đủ thông tin!", "error");
            return;
        }
    }

    //UPDATE
    //UPDATE
    //UPDATE
    //UPDATE

    //CALL
    swal("Cảnh báo", "Chưa hoạt động", "warning")
    .then(() => swal("Thành công", "", "success"));

}
