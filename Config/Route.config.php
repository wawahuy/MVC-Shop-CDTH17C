<?php

    //Cấu hình route
    $routes = [
        //Check login
        [
            "method"   => "get",
            "path"     => "*",
            "process"  => "Controller:Login@AutoLogin"
        ],

        //Home Page
        [
            "method"  => "get",
            "path"    => "/",
            "process" => "Controller:Home"
        ],

        //Login & Logout Page
        [
            "method"  => "get",
            "path"    => "/login",
            "process" => "Controller:Login"
        ],

        [
            "method"  => "post",
            "path"    => "/login/submit",
            "process" => "Controller:Login@LoginSubmit"
        ],

        [
            "method"  => "get",
            "path"    => "/logout",
            "process" => "Controller:Login@Logout"
        ],

        [
            "method"        => "get",
            "path"          => "/login/app/[app]",
            "process"       => "Controller:Login@LoginApp",
            "constraint"    => [
                "app" => "[\w|\d]+"
            ]
        ],


        //Register Page
        [
            "method"  => "get",
            "path"    => "/register",
            "process" => "Controller:Register"
        ],

        [
            "method"  => "post",
            "path"    => "/register/submit",
            "process" => "Controller:Register@RegisterSubmit"
        ],


        //Categories Page
        [
            "method"    =>  "get",
            "path"      =>  "/categories",
            "process"   =>  "Controller:Categories"
        ],

        [
            "method"    =>  "get",
            "path"      =>  "/categories/[id]/[name]",
            "process"   =>  "Controller:Categories@View",
            "constraint" => [
                "id" => "[\d]+"
            ]
        ],

        [
            "method"    =>  "get",
            "path"      =>  "/categories/[id]/page/[page]/[name]",
            "process"   =>  "Controller:Categories@View",
            "constraint" => [
                "id" => "[\d]+",
                "page" => "[\d]+"
            ]
        ],



        //Products Page
        [
            "method"    =>  "get",
            "path"      =>  "/product",
            "process"   =>  "Controller:Product"
        ],

        [
            "method"    =>  "get",
            "path"      =>  "/product/[id]",
            "process"   =>  "Controller:Product@View",
            "constraint" => [
                "id" => "[\d]*"
            ]
        ],


        //Bag
        [
            "method"    =>  "get",
            "path"      =>  "/bag",
            "process"   =>  "Controller:Bag"
        ],

        [
            "method"    =>  "post",
            "path"      =>  "/bag/add",
            "process"   =>  "Controller:Bag@Add"
        ],


        //Error Page
        [
            "method"  => "notraffic",
            "process" => "Controller:PageError"
        ]
    ];


    Route::config($routes);

?>