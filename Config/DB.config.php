<?php
    // define("HOSTDB", "127.0.0.1");
    // define("USERDB", "root");
    // define("PASSDB", "");
    // define("NAMEDB", "qlbanhang");
    // define("PORTDB", 3306);

    define("HOSTDB", getenv("MYSQL_SERVICE_HOST"));
    define("USERDB", "username");
    define("PASSDB", "password");
    define("NAMEDB", "qlbanhang");
    define("PORTDB", getenv("MYSQL_SERVICE_PORT"));

?>