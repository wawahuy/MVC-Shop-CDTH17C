/*
    - chương trình trình diễn slides
    - tấc cả các slides được trình diễn chng yêu cầu dặt trong id: container-slides
    - các đối tượng được trình diễn yêu cầu đặt trong class: slides
*/


var Slides = {};
//chứa các class effect có cấu trúc [](hide, unhide);
Slides.effects = [];

/*
    - hàm khởi chạy mặc định
    - cập nhạt các container
    - @sleep: thời gian trinh diễn giữa 2 slides
*/
Slides.init = function ( sleep ){
    //thời gian ngủ của slides show
    Slides.sleep = sleep;
    Slides.main = document.getElementById('container-slides');
    Slides.container = Slides.main.getElementsByClassName("slides");
    //thông số chĩnh
    Slides.count_slide = Slides.container.length;
    Slides.count_effect = Slides.effects.length;
    Slides.index = 0;
    Slides.old_index = Slides.count_slide-1;
    //cập nhât và khởi tạo sự kiện lấy chiều rộng
    //Slides.updateFullHeight();
    //window.addEventListener("resize", Slides.updateFullHeight, false);
    //tạo button danh sách
    Slides.createButtonUpdate();
    //thêm sự kiện ấn phải , trái
    Slides.main.getElementsByClassName("btRight")[0].addEventListener("click", Slides.ForwardSlide, false);
    Slides.main.getElementsByClassName("btLeft")[0].addEventListener("click", Slides.BackSlide, false);
    Slides.run();
}

/*
    - tạo danh sách button ở duwosi chân ảnh
*/
Slides.createButtonUpdate = function (){
    Slides.buttonSlides = [];
    //tạo container chúa danh sách button
    btSlides = document.createElement("div");
    btSlides.className = "listBTSlides";
    //thêm các button slides
    for(i=0, len=Slides.container.length; i<len; i++){
        btSl = document.createElement("div");
        btSl.id = "SlideButton"+i;
        btSl.onclick = Slides.clickButtonUpdate;
        btSlides.appendChild( btSl );
        Slides.buttonSlides.push( btSl );
    }
    //thêm vào container slides
    document.getElementById('container-slides').appendChild( btSlides );
}


/*
    - cập nhật danh sách button ở duwosi chân ảnh
*/
Slides.referButtonUpdate = function (){
    Slides.buttonSlides[ Slides.old_index ].style = "";
    Slides.buttonSlides[ Slides.index ].style = "opacity: 1";
}


/*
    - sự kiện click button slides
*/
Slides.clickButtonUpdate = function (e){
    target = e.target || e.srcElement;
    id_ = target.id.replace("SlideButton","");
    //xóa sự kiện chuyển tiếp theo
    clearTimeout( Slides.timeout );
    //gán ảnh xuất hiện
    Slides.index = id_;
    //gọi xuất
    Slides.run();
}


/*
    - FULL HEIGHT
*/
Slides.updateFullHeight = function (){
    //đặt lại chiều rộng container = với height
    Slides.container[Slides.index].style.display = "block";
    Slides.main.style.height = Slides.container[Slides.index].clientHeight+"px";
}

/*
    - Cập nhật chiều cao của container slides
    - @height: chiều cao cần thiết lặp
*/
Slides.setHeight = function ( height ){
    Slides.main.style.height = height+"px";
}



/*
    - hàm gọi update slides
*/
Slides.run = function (){
    //rand một pos effect ngẫu nhiên
    rand = Math.round(Math.random()*(Slides.count_effect-1));
    //console.log( Slides.index );
    //gọi effects, hiển thị
    Slides.effects[ rand ]();
    //cập nhật button select mới
    Slides.referButtonUpdate();
    //Update vị trí ảnh sẽ được xuất hiện tiếp thep
    Slides.increase();
    //gọi hàm thực hiện lại quá trình slides show
    Slides.timeout = setTimeout( Slides.run, Slides.sleep );
}


/*
    - gọi khi nhấn đi tới
    - vì ảnh tiếp theo đã được tăng đệm trước nên chỉ cần xóa sự kiện và gọi lại
*/
Slides.ForwardSlide = function (){
    //xóa sự kiện chuyển tiếp theo
    clearTimeout( Slides.timeout );
    //gọi lại
    Slides.run();
}

/*
    - gọi khi nhấn trở lại
*/
Slides.BackSlide = function (){
    //xóa sự kiện chuyển tiếp theo
    clearTimeout( Slides.timeout );
    //gán ảnh mới sẽ = ảnh củ -1
    Slides.index = Slides.old_index-1;
    //kiểm tra khi ảnh <0
    if( Slides.index<0 )
        Slides.index = Slides.count_slide-1;
    //gọi lại
    Slides.run();
}



/*
    - hàm này sẽ tăng ảnh lên theo tru trình 1,2,3... 1,2,3...
*/
Slides.increase = function (){
    //gán vị trí cũ
    Slides.old_index = Slides.index;
    //tăng lên vị trí mới
    Slides.index++;
    //kiểm tra quá vị trí
    if( Slides.index >= Slides.count_slide ) Slides.index = 0;
}

/*
    -được goi sau khoản effect
    -@a: sẽ hide
    -@b: sẽ unhide
*/
Slides.callbackOffEffect = function (a, b){
    b.style = "display: block; animation: efView "+(Slides.sleep-1200)/1000+"s ease-out;";
    //b.style = "display: block";
    a.style = "display: none";

}


/*
    - bao gồm effects từ 0->4
    - @e: la tên anmation
*/
Slides.effect01 = function ( e ){
    Slides.container[ Slides.old_index ].style = `
        display: block;
        z-index: 1;`;
    //tạo hiệu ứng cho slides mới
    Slides.container[ Slides.index ].style = `
        display: block;
        z-index: 2;
        animation: `+e+` 0.3s`;
    //sau time... cho ảnh xuât hiện luôn
    setTimeout( Slides.callbackOffEffect , 300,  Slides.container[ Slides.old_index ], Slides.container[ Slides.index ]);
}


/*
    - gọi 2 effect cho hiệu ứng hide, và un hide
    - @ef1, ef2: hide, và unhide tên animatio
*/
Slides.callTwoEffect = function (ef1, ef2, time){
    Slides.container[ Slides.old_index ].style = `
        display: block;
        z-index: 1;
        animation: `+ef1+` `+time/1000+`s`;
    //tạo hiệu ứng cho slides mới
    Slides.container[ Slides.index ].style = `
        display: block;
        z-index: 2;
        animation: `+ef2+`  `+time/1000+`s`;
    //sau time... cho ảnh xuât hiện luôn
    setTimeout( Slides.callbackOffEffect , time,  Slides.container[ Slides.old_index ], Slides.container[ Slides.index ]);
}


/*
    - effect dịch trái, chồng trên
    - effect này dịch chuyển phần tử xuất hiện phải ->trái, nhờ animation css
*/
Slides.effects[0] = function (){
    Slides.effect01("efRL");
}

/*
    - effect dịch trái, chồng trên
    - effect này dịch chuyển phần tử xuất hiện dưới -> trên, nhờ animation css
*/
Slides.effects[1] = function (){
    Slides.effect01("efBT");
}


/*
    - effect mất đối tượng hiện tại bằng cách thu nhỏ
*/
Slides.effects[2] = function (){
    Slides.callTwoEffect("ef4Out", "ef4In", Slides.effects[2].time);
}
Slides.effects[2].time = 800;


/*
    - effect chuyển đối tượng kéo dãn từ trên -> dưới
*/
Slides.effects[3] = function (){
    Slides.callTwoEffect("ef5Out", "ef5In", Slides.effects[3].time);
}
Slides.effects[3].time = 600;



/*
    - effect chuyển đối tượng kéo dãn từ trái -> phải
*/
Slides.effects[4] = function (){
    Slides.callTwoEffect("ef6Out", "ef6In", Slides.effects[4].time);
}
Slides.effects[4].time = 600;

/*
    - effect chuyển đối tượng kéo dãn từ trái -> phải
*/
Slides.effects[5] = function (){
   Slides.callTwoEffect("", "ef7In", Slides.effects[5].time);
}
Slides.effects[5].time = 600;

/*
    - effect chuyển đối tượng kéo dãn từ trái -> phải
*/
Slides.effects[6] = function (){
   Slides.callTwoEffect("ef8Out", "ef8In", Slides.effects[6].time);
}
Slides.effects[6].time = 600;
