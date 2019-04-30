CCm = {};

CCm.init = function (){
    CCm.DOM = toDomByIDAr([
        "cmpath", "cmcmp", "cmProduct"
    ]);

    /*phân tích path*/
    if(!$_GET['path']) $_GET['path']='';
    var spl = $_GET['path'].split("/");
    var lnk = "chuyenmuc.php?path=";
    var txt = "";
    var txi = "";
    for( var i in spl){
        lnk += spl[i];
        txt += `
            <span>
                <a href="`+lnk+`">`+spl[i]+`</a>
            </span>
        `;
        txi += `
            <span>`+spl[i]+`</span>
        `;
        lnk += "/";
    }
    CCm.DOM.cmpath.innerHTML += txt;
    CCm.DOM.cmcmp.innerHTML += txi+"(25 sản phẩm)";

    /*tổng hợp sản phẩm*/
    CCm.widthP = CCm.DOM.cmProduct.clientWidth;
    CCm.widthC = CCm.widthP/4-20;
    CCm.heightC = 300;
    CCm.createProduct(DATA, "");
    CCm.createProduct(DATA, "");
}

CCm.createProduct = function ( js, lnk ){
    // if( _jssub[k] instanceof Object && !(_jssub[k] instanceof Array) )
    for( var i in js){
        if( js[i] instanceof Object && !(js[i] instanceof Array) ){
            var new_lnk = lnk+'/'+i;
            CCm.createProduct( js[i], new_lnk )
        } else {
            var lnk2 = lnk.substr(1, lnk.length)+'/'+i;
            for( var j in js[i]){
                //console.log(lnk2+'/'+js[i][j].subname+'/'+js[i][j].name);
                CCm.DOM.cmProduct.innerHTML += getProductHTML(js[i][j],
                             lnk2+'/'+js[i][j].subname+'/'+js[i][j].name,
                             "width: "+CCm.widthC+"px;"+
                             "height: "+CCm.heightC+"px;");
            }
        }
    }
}