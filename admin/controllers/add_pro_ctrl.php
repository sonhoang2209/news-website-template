<?php
    include('../../define.php');
    include('../../includes/functions.php');
?>
<!-- isset( $_POST['btn_add_product'] ) -->
<?php
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if( true ){
            $message = array();
            // echo $_POST['product_content'];
            if( isset( $_POST['product_title'] ) && preg_match( '/\p{L}+/u', string_validation( $_POST['product_title'] ) ) ) {
                $product_title = string_validation($_POST['product_title']); 
            } else {
                $message[] = "<div class='alert alert-warning'>product_title</div>";
            }
            //var_dump($product_title);
            if( isset( $_POST['product_content'] ) ) {
                $product_content = $_POST['product_content']; 
            } else {
                $message[] = "<div class='alert alert-warning'>product_content</div>";
            }
            
            if( isset( $_POST['product_author'] ) ) {
                $author = $_POST['product_author']; 
            } else {
                $message[] = "<div class='alert alert-warning'>author</div>";
            }

            if( isset( $_POST['pro_tag'] ) ) {
                $pro_tag =$_POST['pro_tag']; 
            } else {
                $message[] = "<div class='alert alert-warning'>pro_tag</div>";
            }

            $datetime_submitted = time(); 

            if( isset( $_COOKIE['add_image_pro'] ) && !empty( $_COOKIE['add_image_pro'] ) ) {
                $product_visual = $_COOKIE['add_image_pro'];
            } else {
                $message[] = "<div class='alert alert-warning'>product_visual</div>";
            }
            
            if( empty( $message ) ) { 
                $stmt = mysqli_prepare($dbc, "INSERT INTO posts( product_title, product_visual, product_content, datetime_submitted, author, tag) VALUES ( ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "sssiii", $product_title, $product_visual, $product_content, $datetime_submitted, $author, $pro_tag);
                if(  mysqli_stmt_execute( $stmt ) ) {
                    mysqli_stmt_close($stmt);
                    $new_id = mysqli_insert_id( $dbc );setcookie('add_image_pro', "");
                    $message[] = "<div class='alert alert-success'>Add user success</div>";
                    
                } else {
                    $message[] = "<div class='alert alert-warning'>Add user false</div>";
                }
            }

            if(!empty($message)) echo form_message($message) ;
            
        }
    }
?>
