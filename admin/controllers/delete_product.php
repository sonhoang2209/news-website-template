<?php
    include('../../define.php');
    include('../../includes/functions.php');
?>
<?php
    if( isset( $_POST['id'] ) ){
        $id = $_POST['id'];
        $sql = "DELETE FROM posts WHERE product_id = $id ";
        if( mysqli_query( $dbc, $sql ) ) {
            echo 'delete success';
        } else {
            echo 'false';
        }
    }
?>