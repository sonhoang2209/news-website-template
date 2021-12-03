<?php 
    session_start();
    define( 'SITE_URL', 'http://localhost/study/projects/news/source/' );
    define( 'ROOT', __DIR__ . '/' );
    define( 'ASSETS', ROOT . 'assets/' );
    define( 'IMAGES', SITE_URL . 'images/' );
    
    define( 'ADMIN_URL', SITE_URL . 'admin/' );
    define( 'ADMIN_ASSETS', ROOT . 'admin/assets/' );
    define( 'ADMIN_IMAGES', SITE_URL . 'admin/assets/images/' );

    //database define
    define( 'DB_HOST', 'localhost' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASS', '' );
    define( 'DB_NAME', 'news' );

    include( 'includes/mysqli_connect.php' );
?>