<?php
    $number = 1234567;
    $ar = array();
    $br = array();
    $num = strlen($number);
    for( $i = 0; $i < $num; $i++  ){
        $ar[] .= $number % 10;
        if( $number / 10 != 0 ){
            $number =  $number / 10;
        }
    }
    var_dump($ar);
    for( $i = 0; $i< $num/2; $i++ ) {

    }
?>