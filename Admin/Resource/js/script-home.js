//class home page
Home = {};

//khởi tạo home
Home.init = function (){
    Home.body = document.getElementById("body-home");
    //thực hiện gọi xử lí header
    Header.init();
    //thực hiện gọi slides
    Slides.init( 6000 ); 
    //thêm sự kiện kiểm tra kích thước slides 100% height
    Home.resize();
    window.addEventListener("resize", Home.resize, false);
    //thêm xử lí khi scroll hêt header
    Header.addScrollBottom( Home.eventScrollHeader );
    //block
    Home.body.style.display = "block";

    //khởi tạo slide hot
    Home.hotPro = new SlidesProduct(document.getElementById("hot-product"), 250, 5);
    Home.hotPro.init();

    Home.hotSale = new SlidesProduct(document.getElementById("hot-sale"), 250, 5);
    Home.hotSale.init();

}

//sự kiện khi resize
Home.resize = function (){
   Header.newHeight = window.innerHeight;
   //cập nhật cho container Slides
   Slides.setHeight(Header.newHeight);
   //cập nhật cho header = 2 lần chiều cao
   Header.setHeight(Header.newHeight*2);
   
}


//xóa fixed cho home
Home.removeFixed = function (){
    Home.body.className = "";
}

//thêm fixed cho home
Home.addFixed = function (){
    Home.body.className = "body-home-fixed";
}

//sự kiến khi header chưa được ẩn, top < clientheight
Home.eventScrollHeader = function (){
    //xóa sự kiện khi scroll hết header
    Header.removeScrollBottom();
    //gán cho slides về relative
    Header.relativeHeader();
    //xóa sự kiện cập nhật header height
    window.removeEventListener("resize", Home.resize, false);
    //xóa trang thái fixed của body
    Home.removeFixed(); 
    //fixed header
    Header.fixedBarMenu();
    //add sự kiện ngược lại
    window.addEventListener("scroll", Home.eventScrollTop, false);
    //thêm back top
    Header.addBackTop();
}

//sự kiện khi header được đông bộ
Home.eventScrollTop = function (){
    
    if( getScroll() < Header.newHeight){
        //gán cho header về absolute
        Header.absoluteHeader();
        //xóa sự kiện scrol top header
        window.removeEventListener("scroll", Home.eventScrollTop, false);
        //thêm trang thái fixed của body
        Home.addFixed(); 
        //abs header
        Header.absoluteBarMenu();
        //thêm sự kiện kiểm tra kích thước slides 100% height
        Home.resize();
        window.addEventListener("resize", Home.resize, false);
        //thêm xử lí khi scroll top header
        Header.addScrollBottom( Home.eventScrollHeader );
        //xóa back top
        Header.removeBackTop();
    }
}


function checkPlayVideo(){

}