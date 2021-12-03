<?php include('templates/header.admin.tpl.php') ?>
<?php include('templates/head.admin.tpl.php') ?>
<?php include('templates/sidebar.admin.tpl.php') ?>

<!--main-->
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Add Product
                <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                </div>
            </div>
        </div>   
    </div>
</div>

<!-- message -->
<?php if( ! empty( $message ) ) form_message( $message ) ; ?>
<!-- form -->
<div class="row mb-4">
    <div class="card-body main-card card">
        <h5 class="card-title">Basic information post</h5>
        <form class="formtest" action="controllers/add_pro_ctrl.php" method="post">
            <div class="position-relative form-group">
                    <label for="tourName" class="">Product Title</label>
                    <input name="product_title" id="tourName" placeholder="tour name" type="text" class="form-control">
            </div>
            <div class="position-relative form-group preview_avatar">
                <label for="exampleFile" class="">Visual Image</label>
                <input id="visual_image" name="visual_image" type="file" class="form-control-file preview">
                <img class="preview_img">
            </div>
            <div class="position-relative form-group display-none">
                <label for="tourName" class="">id</label>
                <input name="product_author" id="tourName" placeholder="tour name" type="text" class="form-control" value="<?php echo $_SESSION['user_id'] ?>" >
            </div>
            <div class="position-relative form-group">
                <label for="tourName" class="">Product Tag</label>
                <input name="pro_tag" id="tourName" placeholder="tour name" type="text" class="form-control">
            </div>

            <script src="ckeditor/ckeditor.js"></script>
            <script src="ckeditor/samples/js/sample.js"></script>
            <link rel="stylesheet" href="ckeditor/samples/css/samples.css">
            <link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

            <div class="position-relative form-group">
                <label for="saleOf" class="">Product Content</label>
                <textarea name="product_content" id="editor1" rows="10" cols="80">   
                </textarea>
                <script>
                    CKEDITOR.replace( 'product_content' );
                </script>
            </div>
            <input class="mt-1 btn btn-primary btn_add_product" type="submit" name="btn_add_product" value="Add Tour" />
        </form>
    </div>
</div>

<?php include('templates/footer.admin.tpl.php') ?>