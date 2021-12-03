<?php
    include('define.php');
    include('includes/functions.php');
?>

<?php
    if( isset( $_POST ) ){
        $id = $_POST['id'];
        $sql = "delete from test where test_id= $id ";
        mysqli_query($dbc,$sql);
        echo 'delete success';
    }
?>
