<?php

$ROUTES= [
    [
        "method"   => "get",
        "path"     => "/",
        "process"  => "Controller/Home.controller(HomeController)"
    ],

    [
        "method"   => "get",
        "path"     => "/login",
        "process"  => "Controller/Login.controller(LoginController)"
    ],


    [
        "method"   => "get",
        "path"     => "/logout",
        "process"  => "Controller/Login.controller(LoginController)->Logout"
    ],

    [
        "method"   => "post",
        "path"     => "/login/submit",
        "process"  => "Controller/Login.controller(LoginController)->Submit"
    ],
    
    //trang thống kê
    [
        "method"   => "get",
        "path"     => "/statistical",
        "process"  => "Controller/Statistical.controller(StatisticalController)"
    ],
    //trang khach hang
    [
        "method"   => "get",
        "path"     => "/user_management",
        "process"  => "Controller/User.controller(UserController)"
    ],
    //trang quan li don hang
    
    [
        "method"   => "get",
        "path"     => "/order_management",
        "process"  => "Controller/Order.controller(OrderController)"
    ],
     //trang quan li don hang
    
     [
        "method"   => "get",
        "path"     => "/product_management",
        "process"  => "Controller/Product.controller(ProductController)"
    ],
];


?>