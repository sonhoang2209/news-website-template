<?php
    include('../define.php');
    include('../includes/functions.php');
    if( ! $user_logged_in_cookie = get_current_user_cookie() ) {
        redirect_to( ADMIN_URL, 'login.php' );
    }
    $user_logged_in = get_user_by_id($_SESSION['user_id']);

    if( $avatar = get_avatar_profile( $user_logged_in['avatar'] ) ){

    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analytics.</title>
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/fix.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="assets/js/default.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">