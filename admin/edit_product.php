<?php include('templates/header.admin.tpl.php') ?>
<?php include('templates/head.admin.tpl.php') ?>
<?php include('templates/sidebar.admin.tpl.php') ?>

<?php
    if( ! $post_id = id_validation() ){
        exit();
    }

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if( isset( $_POST['btn_upd_product'] ) ){
            $message = array();

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

            if( isset( $_POST['pro_tag'] ) ) {
                $pro_tag =$_POST['pro_tag']; 
            } else {
                $message[] = "<div class='alert alert-warning'>pro_tag</div>";
            }

            $datetime_update = time(); 

            if( empty($message) ) { 
                $stmt = mysqli_prepare($dbc, "UPDATE posts SET product_title = ?, product_content = ?, datetime_update = ?, tag = ? WHERE product_id = ?");
                mysqli_stmt_bind_param($stmt, "ssiii", $product_title, $product_content, $datetime_update, $pro_tag, $post_id);
                if(  mysqli_stmt_execute( $stmt ) ) {
                    mysqli_stmt_close($stmt);
                    $message[] = "<div class='alert alert-success'>update success</div>";
                } else {
                    $message[] = "<div class='alert alert-warning'>You may not have activated your account yet.</div>";
                }
            }
        }
    }

    if( ! $post_data = get_post_by_id( $post_id ) ){
        exit();
    }



?>

<!--main-->
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Edit Product
                <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                </div>
            </div>
        </div>   
    </div>
</div>
<?php if( ! empty( $message ) ) form_message( $message ) ; ?>
<div class="row mb-4">
    <div class="card-body main-card card">
        <h5 class="card-title">Basic information post</h5>
        <form method="post">
            <input class="display_none" type="text" name="post_id" value="<?php echo $post_id; ?>" />
            <div class="position-relative form-group">
                <label for="tourName" class="">Product Title</label>
                <input name="product_title" id="tourName" placeholder="tour name" type="text" class="form-control" value="<?php echo $post_data['product_title']; ?>">
            </div>

            <div class="position-relative form-group preview_avatar">
                <label for="exampleFile" class="">Visual Image</label>
                <input id="visual_image" name="visual_image" type="file" class="form-control-file preview">
                <img class="preview_img" src="../images/products/<?php echo $post_data['product_visual']; ?>">
            </div>

            <div class="position-relative form-group display-none">
                <label for="tourName" class="">id</label>
                <input name="product_author" id="tourName" placeholder="tour name" type="text" class="form-control" value="<?php echo $post_data['author']; ?>" >
            </div>

            <div class="position-relative form-group">
                <label for="tourName" class="">Product Tag</label>
                <input name="pro_tag" id="tourName" placeholder="tour name" type="text" class="form-control" value="<?php echo $post_data['tag']; ?>">
            </div>

            <script src="ckeditor/ckeditor.js"></script>
            <script src="ckeditor/samples/js/sample.js"></script>
            <link rel="stylesheet" href="ckeditor/samples/css/samples.css">
            <link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

            <div class="position-relative form-group">
                <label for="saleOf" class="">Product Content</label>
                <textarea name="product_content" id="editor1" rows="10" cols="80"><?php echo $post_data['product_content']; ?>
                </textarea>
                <script>
                    CKEDITOR.replace( 'product_content' );
                </script>
            </div>
            <input class="mt-1 btn btn-primary btn_upd_product" type="submit" name="btn_upd_product" value="Update Tour" />
        </form>
    </div>
</div>



<?php include('templates/footer.admin.tpl.php') ?>