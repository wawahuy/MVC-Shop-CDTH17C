<?php

$ROUTES= [
    //Check login
    [
        "method"   => "get",
        "path"     => "*",
        "process"  => "Controller/Login.controller(LoginController)->CheckLogin"
    ],

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
 
     //trang quan li binh luan

     [
        "method"   => "get",
        "path"     => "/comment_management",
        "process"  => "Controller/Comment.controller(CommentController)"
     ],

     //duyet binh luan
     [
        "method"   => "get",
        "path"     => "/comment_management/confirm/[id]",
        "process"  => "Controller/Comment.controller(CommentController)->comment_confirmed",
        "constraint" => [
            "id" => "[\d]*"
        ]
     ],
     //xoa binh luan

     [
        "method"   => "get",
        "path"     => "/comment_management/remove/[id]",
        "process"  => "Controller/Comment.controller(CommentController)->comment_remove",
        "constraint" => [
            "id" => "[\d]*"
        ]
     ],

     //xoa du lieu khach hang
     [
        "method"   => "get",
        "path"     => "/user_management/remove/[id]",
        "process"  => "Controller/User.controller(UserController)->user_remove",
        "constraint" => [
            "id" => "[\d]*"
        ]
     ],


    //cam du lieu khach hang
     [
        "method"   => "get",
        "path"     => "/user_management/active/[id]",
        "process"  => "Controller/User.controller(UserController)->user_active",
        "constraint" => [
            "id" => "[\d]*"
        ]
     ],


    //bo cam du lieu khach hang
     [
        "method"   => "get",
        "path"     => "/user_management/deactive/[id]",
        "process"  => "Controller/User.controller(UserController)->user_deactive",
        "constraint" => [
            "id" => "[\d]*"
        ]
        ],

    //trang quan li don hang
    
     [
        "method"   => "get",
        "path"     => "/product_management",
        "process"  => "Controller/Product.controller(ProductController)"
    ],

    [
        "method"   => "get",
        "path"     => "/product_management/addproduct",
        "process"  => "Controller/Product.controller(ProductController)->add_product"
    ],


    [
        "method"   => "post",
        "path"     => "/product_management/addproduct",
        "process"  => "Controller/Product.controller(ProductController)->add_product_submit"
    ],
];


?>