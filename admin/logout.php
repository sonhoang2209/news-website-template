<?php
    include('../define.php');
    include('../includes/functions.php');
    if( isset( $_SESSION['user_id'] ) ) {
        unset($_SESSION['user_id']);
        unset($_SESSION['full_name']);
        setcookie( 'user_logged_in', '', time() - 3600,'/');
        redirect_to();
    } 