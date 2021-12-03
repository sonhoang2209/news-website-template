<?php
    $dbc = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(!$dbc){
        trigger_error("could not connect to db:" . mysqli_connect_error());
    }
    else{
        mysqli_set_charset($dbc,'utf-8');
    }
?>