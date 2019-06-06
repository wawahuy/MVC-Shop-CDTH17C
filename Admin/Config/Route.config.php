<?php

$ROUTES= [
    //Check login
    [
        "method"   => "get",
        "path"     => "*",
        "process"  => "Admin/Controller/Login.controller(LoginController)->CheckLogin"
    ],

    [
        "method"   => "get",
        "path"     => "/",
        "process"  => "Admin/Controller/Home.controller(HomeController)"
    ],

    [
        "method"   => "get",
        "path"     => "/login",
        "process"  => "Admin/Controller/Login.controller(LoginController)"
    ],


    [
        "method"   => "get",
        "path"     => "/logout",
        "process"  => "Admin/Controller/Login.controller(LoginController)->Logout"
    ],

    [
        "method"   => "post",
        "path"     => "/login/submit",
        "process"  => "Admin/Controller/Login.controller(LoginController)->Submit"
    ],

    //trang khach hang
    [
        "method"   => "get",
        "path"     => "/user_management",
        "process"  => "Admin/Controller/User.controller(UserController)"
    ],
    //trang quan li don hang
    
    [
        "method"   => "get",
        "path"     => "/order_management",
        "process"  => "Admin/Controller/Order.controller(OrderController)"
    ],


    [
        "method"   => "get",
        "path"     => "/order_management/[id]",
        "process"  => "Admin/Controller/Order.controller(OrderController)->updateStatus",
        "constraint" => [
            "id" => "[\d]+"
        ]
    ],

    [
        "method"   => "get",
        "path"     => "/order_management/view/[id]",
        "process"  => "Admin/Controller/Order.controller(OrderController)->view",
        "constraint" => [
            "id" => "[\d]*"
        ]
    ],
 
 
     //trang quan li binh luan

     [
        "method"   => "get",
        "path"     => "/comment_management",
        "process"  => "Admin/Controller/Comment.controller(CommentController)"
     ],

     //duyet binh luan
     [
        "method"   => "get",
        "path"     => "/comment_management/confirm/[id]",
        "process"  => "Admin/Controller/Comment.controller(CommentController)->comment_confirmed",
        "constraint" => [
            "id" => "[\d]*"
        ]
     ],
     //xoa binh luan

     [
        "method"   => "get",
        "path"     => "/comment_management/remove/[id]",
        "process"  => "Admin/Controller/Comment.controller(CommentController)->comment_remove",
        "constraint" => [
            "id" => "[\d]*"
        ]
     ],

     //xoa du lieu khach hang
     [
        "method"   => "get",
        "path"     => "/user_management/remove/[id]",
        "process"  => "Admin/Controller/User.controller(UserController)->user_remove",
        "constraint" => [
            "id" => "[\d]*"
        ]
     ],


    //cam du lieu khach hang
     [
        "method"   => "get",
        "path"     => "/user_management/active/[id]",
        "process"  => "Admin/Controller/User.controller(UserController)->user_active",
        "constraint" => [
            "id" => "[\d]*"
        ]
     ],


    //bo cam du lieu khach hang
     [
        "method"   => "get",
        "path"     => "/user_management/deactive/[id]",
        "process"  => "Admin/Controller/User.controller(UserController)->user_deactive",
        "constraint" => [
            "id" => "[\d]*"
        ]
        ],

    //trang quan li don hang
    
     [
        "method"   => "get",
        "path"     => "/product_management",
        "process"  => "Admin/Controller/Product.controller(ProductController)"
    ],

    [
        "method"   => "get",
        "path"     => "/product_management/addproduct",
        "process"  => "Admin/Controller/Product.controller(ProductController)->add_product"
    ],


    [
        "method"   => "post",
        "path"     => "/product_management/addproduct",
        "process"  => "Admin/Controller/Product.controller(ProductController)->add_product_submit"
    ],

    [
        "method"   => "get",
        "path"     => "/product_management/edit/[id]",
        "process"  => "Admin/Controller/Product.controller(ProductController)->edit_product",
        "constraint" => [
            "id" => "[\d]*"
        ]
    ],


    [
        "method"   => "post",
        "path"     => "/product_management/edit/[id]",
        "process"  => "Admin/Controller/Product.controller(ProductController)->edit_product_submit",
        "constraint" => [
            "id" => "[\d]*"
        ]
    ],

    [
        "method"   => "get",
        "path"     => "/product_management/remove/[id]",
        "process"  => "Admin/Controller/Product.controller(ProductController)->delete_product",
        "constraint" => [
            "id" => "[\d]*"
        ]
    ],
];


?>