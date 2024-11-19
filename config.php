<?php

define ('DEBUG', true);

define('APP_NAME', 'Basic   Framework');
define('APP_DESCRIPTION', 'Framework create in php with plugin.');

if((empty($_SERVER['SERVER_NAME']) && strpos(PHP_SAPI, 'cgi') !== 0) || (!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost:8889')) {
    define( 'DB_NAME' , 'basic_framework' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASSWORD', 'root' );
    define( 'DB_HOST', 'localhost' );
    define( 'DB_PORT', 8889 );
    define( 'DB_DRIVER', 'mysql' );

    define ('ROOT', 'http://localhost:8888/basic-framework');
} else {
    // toto je pro online verzi, pak upravit 
    define( 'DB_NAME' , 'basic_framework' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASSWORD', 'root' );
    define( 'DB_HOST', 'localhost' );
    define( 'DB_PORT', 8889 );
    define( 'DB_DRIVER', 'mysql' );

    define ('ROOT', 'http://localhost:8888/basic-framework');
}



