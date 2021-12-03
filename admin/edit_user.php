<?php include('templates/header.admin.tpl.php') ?>
<?php include('templates/head.admin.tpl.php') ?>
<?php include('templates/sidebar.admin.tpl.php') ?>
<?php
    if( ! $user_id = id_validation() ){
        exit();
    }
?>
<?php
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if( isset( $_POST['update'] ) ){
            $message = array();

            if( isset( $_POST['first_name'] ) && preg_match( '/\p{L}+/u', string_validation( $_POST['first_name'] ) ) ) {
                $first_name = string_validation($_POST['first_name']); 
            } else {
                $message[] = "<div class='alert alert-warning'>first_name</div>";
            }

            if( isset( $_POST['last_name']) && preg_match('/\p{L}+/u', string_validation( $_POST['last_name'] ) ) ) {
                $last_name = string_validation( $_POST['last_name'] );
            } else {
                $message[] = "<div class='alert alert-warning'>last_name</div>";
            }

            if( isset( $_POST['email']) && preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', string_validation( $_POST['email'] ) ) ) {
                $email = string_validation( $_POST['email'] );
            } else {
                $message[] = "<div class='alert alert-warning'>email</div>";
            }

            if( isset( $_POST['phone']) && preg_match('/^[0-9]{5,20}$/', string_validation( $_POST['phone'] ) ) ) {
                $phone = string_validation( $_POST['phone'] );
            } else {
                $message[] = "<div class='alert alert-warning'>phone</div>";
            }

            if( empty($message) ) { 
                $stmt = mysqli_prepare($dbc, "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE user_id = ?");
                mysqli_stmt_bind_param($stmt, "sssii", $first_name, $last_name, $email, $phone, $user_id);
                if(  mysqli_stmt_execute( $stmt ) ) {
                    mysqli_stmt_close($stmt);
                    $message[] = "<div class='alert alert-success'>update success</div>";
                } else {
                    $message[] = "<div class='alert alert-warning'>You may not have activated your account yet.</div>";
                }
            }
        }
    }
    if( ! $user_info = get_user_by_id( $user_id ) ){
        exit();
    } else {
        $avatar_profile = get_avatar_profile( $user_info['avatar'] );
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
            <div>Edit User Info
                <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                </div>
            </div>
        </div>   
    </div>
</div>
<?php if( ! empty( $message ) ) form_message( $message ) ; ?>
<div class="row mb-4">
    <div class="col-md-8">
        <div class="main-card card">
            <div class="card-body"><h5 class="card-title">user info</h5>
                <form class="" method="post" action="edit_user.php?id=<?php echo $user_id; ?>">
                    <div class="position-relative row form-group"><label class="col-sm-2 col-form-label">First name</label>
                        <div class="col-sm-10"><input name="first_name"  placeholder="" type="text" class="form-control" value="<?php if( isset( $user_info['first_name'] ) ) echo $user_info['first_name']; ?>"></div>
                    </div>
                    <div class="position-relative row form-group"><label  class="col-sm-2 col-form-label">Last name</label>
                        <div class="col-sm-10"><input name="last_name"  placeholder="" type="text" class="form-control" value="<?php if( isset( $user_info['first_name'] ) ) echo $user_info['last_name']; ?>"></div>
                    </div>
                    <div class="position-relative row form-group"><label  class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10"><input name="email"  placeholder="" type="text" class="form-control" value="<?php if( isset( $user_info['first_name'] ) ) echo $user_info['email']; ?>"></div>
                    </div>
                    <div class="position-relative row form-group"><label  class="col-sm-2 col-form-label">phone</label>
                        <div class="col-sm-10"><input name="phone"  placeholder="" type="tel" class="form-control" value="<?php if( isset( $user_info['first_name'] ) ) echo $user_info['phone']; ?>"></div>
                    </div>
                    <div class="position-relative row form-check">
                        <input type="submit" name="update" value="Update" class="btn-info btn submit-user-info">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 card">
        <div class="card-body d-flex align-items-center justify-content-center">
            <form class="form-avatar">
                <div class="avatar preview_avatar position-relative">
                    <img src="<?php echo $avatar_profile ?>" id='preview-img' />
                    <div class="file-upload position-absolute">
                        <input type="file" name="input-avatar" />
                        <input type="text" name="user_id" value="<?php echo $user_id; ?>" />
                        <i class="fa fa-arrow-up"></i>
                    </div>
                    
                </div>
                <h3><?php echo $user_info['first_name']. ' ' .$user_info['last_name']; ?></h3>
            </form>
        </div>
    </div>
</div>
<?php include('templates/footer.admin.tpl.php') ?>