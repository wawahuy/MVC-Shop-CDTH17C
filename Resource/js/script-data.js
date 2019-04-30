

//dữ liệu được để trong DATA Object
DATA = {
    //danh sách các chuyên mục "Nam"
    "Riêng Nam": {
        "Áo": {
            "Áo Thun": [],
            "Áo Sơ Mi": [],
            "Áo Khoát": [],
            "Áo len": []
        },
        "Quần": {
            "Quần Dài": [],
            "Quần Jean": [],
            "Quần Sip": [],
            "Quần Tây": [],
            "Quần Kaki": [],
            "Quần Short": []
        },
        "Giày": {
            "Giày Sneaker": [],
            "Giày Vải": [],
            "Giày Casual": []
        }
    },

    //danh sách các chuyên mục "Nữ"
    "Riêng Nữ": {
        "Áo": {
            "Áo Dài": [],
            "Áo Thun": [],
            "Áo Khoát": [],
            "Áo Ren": [],
            "Áo Trễ Vai": [],
            "Áo Sơ Mi": []
        },
        "Quần": {
            "Quần Tây": [],
            "Quần Jean": [],
            "Quần Short": []
        },
        "Đầm": [],
        "Đồ Bộ": []
    },

    //danh mục các chuyên mục "trẻ em"
    "Trẻ Em" : {
        "Áo": [],
        "Quần": [],
        "Đồ Bộ": [],
        "Giày": []
    },

    //danh mục các chuyên mục "phụ kiện"
    "Phụ Kiện" : {
        "Nón": [],
        "Kính": [],
        "Khẩu Trang": [],
        "Dây Nịch": [],
        "Đông Hồ": [],
        "Giày": [],
        "Balo": []
    }
}


/*thêm sản phẩm*/

/*phụ kiên*/
DATA["Phụ Kiện"]["Giày"].push({
    img: "img/sanpham/giay-gyty.jpg",
    name: "Giày GYTY",
    note: "HOT",
    coin: "1500000",
    star: "4",
    subname: "_A"
});


/*nam*/

DATA["Riêng Nam"]["Áo"]["Áo Thun"].push({
    img: "img/sanpham/ao-thun-nam-1.jpg",
    name: "Áo thun",
    sale: "80",
    coin: "100000",
    star: "2",
    subname: "_A"
});


/*nữ*/
//đầm
DATA["Riêng Nữ"]["Đầm"].push({
    img: "img/sanpham/dam-sat-nach-nu.jpg",
    name: "Đầm sát nách",
    sale: "33",
    coin: "120000",
    star: "2",
    subname: "_A"
});


//áo thun
DATA["Riêng Nữ"]["Áo"]["Áo Thun"].push({
    img: "img/sanpham/ao-tre-vai-2-day.jpg",
    name: "Áo trễ vai",
    sale: "70",
    coin: "300000",
    star: "4",
    subname: "_A"
});

//áo trễ vai
DATA["Riêng Nữ"]["Áo"]["Áo Trễ Vai"].push({
    img: "img/sanpham/ao-tre-vai-that-no.jpg",
    name: "Áo trễ vai",
    sale: "40",
    coin: "100000",
    star: "5",
    subname: "_B"
});

//áo ren
DATA["Riêng Nữ"]["Áo"]["Áo Ren"].push({
    img: "img/sanpham/au-ren-2-lop-theu-hoa.jpg",
    name: "Áo thun phong",
    sale: "49",
    coin: "150000",
    star: "4",
    subname: "_A"
});

//balo ba-lo-nn-pc-1.jpg
DATA["Phụ Kiện"]["Balo"].push({
    img: "img/sanpham/ba-lo-nn-pc-1.jpg",
    name: "Balo HQ PK",
    note: "HOT",
    coin: "396000",
    star: "5",
    subname: "_A"
});

//do-bo-kate-co-tui.jpg
DATA["Riêng Nữ"]["Đồ Bộ"].push({
    img: "img/sanpham/do-bo-kate-co-tui.jpg",
    name: "Đồ Bộ Kate",
    note: "HOT",
    coin: "60000",
    star: "5",
    subname: "_A"
});

//ao-so-mi-hong.jpg
DATA["Riêng Nữ"]["Áo"]["Áo Sơ Mi"].push({
    img: "img/sanpham/ao-so-mi-hong.jpg",
    name: "Áo Sơ Mi Hồng",
    sale: "50",
    coin: "200000",
    star: "4",
    subname: "_A"
});

//ao-tre-vai-phoi-mau.jpg
DATA["Riêng Nữ"]["Áo"]["Áo Trễ Vai"].push({
    img: "img/sanpham/ao-tre-vai-phoi-mau.jpg",
    name: "Áo trễ vai màu",
    sale: "40",
    coin: "150000",
    star: "5",
    subname: "_C"
});

//quan-tay-nam-tuyet.jpg
DATA["Riêng Nam"]["Quần"]["Quần Tây"].push({
    img: "img/sanpham/quan-tay-nam-tuyet.jpg",
    name: "Quần Tây Nam",
    sale: "40",
    coin: "250000",
    star: "5",
    subname: "_C"
});

/*sản phẩm hot*/
DATA_HOT_PRODUCT = [
    "Phụ Kiện/Giày/_A/Giày GYTY",
    "Phụ Kiện/Balo/_A/Balo HQ PK",
    "Riêng Nữ/Đồ Bộ/_A/Đồ Bộ Kate",
    "Riêng Nữ/Áo/Áo Sơ Mi/_A/Áo Sơ Mi Hồng",
    "Riêng Nữ/Áo/Áo Trễ Vai/_C/Áo trễ vai màu",
    "Phụ Kiện/Giày/_A/Giày GYTY",
    "Phụ Kiện/Giày/_A/Giày GYTY",
    "Phụ Kiện/Giày/_A/Giày GYTY",
    "Phụ Kiện/Giày/_A/Giày GYTY",
    "Phụ Kiện/Giày/_A/Giày GYTY"
]

DATA_HOT_SALE = [
    "Riêng Nữ/Áo/Áo Thun/_A/Áo trễ vai",
    "Riêng Nữ/Đầm/_A/Đầm sát nách",
    "Riêng Nữ/Áo/Áo Ren/_A/Áo thun phong",
    "Riêng Nam/Áo/Áo Thun/_A/Áo thun",
    "Riêng Nữ/Áo/Áo Trễ Vai/_B/Áo trễ vai",
    "Riêng Nam/Áo/Áo Thun/_A/Áo thun",
    "Riêng Nam/Áo/Áo Thun/_A/Áo thun",
    "Riêng Nam/Áo/Áo Thun/_A/Áo thun",
    "Riêng Nam/Áo/Áo Thun/_A/Áo thun",
    "Riêng Nam/Áo/Áo Thun/_A/Áo thun"
]