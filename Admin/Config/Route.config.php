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
];


?>