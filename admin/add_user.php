<?php include('templates/header.admin.tpl.php') ?>
<?php include('templates/head.admin.tpl.php') ?>
<?php include('templates/sidebar.admin.tpl.php') ?>

<?php
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if( isset( $_POST['add_user'] ) ){
            $message = array();

            if( isset( $_POST['username'] ) && preg_match( '/^[a-z0-9]{2,20}$/i', string_validation( $_POST['username'] ) ) ) {
                $username = string_validation($_POST['username']); 
            } else {
                $message[] = "<div class='alert alert-warning'>username</div>";
            }
            
            // Validate password
            if( isset( $_POST['password'] ) && preg_match('/[a-z0-9]{2,20}$/i', string_validation( $_POST['password'] ) ) ) {
                $pass = md5( string_validation( $_POST['password'] ) );
            } else {
                $message[] = "<div class='alert alert-warning'>password</div>";
            }

            if( isset( $_POST['re_password'] ) && preg_match('/[a-z0-9]{2,20}$/i', string_validation( $_POST['re_password'] ) ) ) {
                $re_pass = md5( string_validation( $_POST['re_password'] ) );

                if( $pass == $re_pass ) {
                    $pass = md5( string_validation( $_POST['password'] ) );
                } else {
                    $message[] = "<div class='alert alert-warning'>pass other repass</div>";
                }
            } else {
                $message[] = "<div class='alert alert-warning'>re-password</div>";
            }

            if( isset( $_POST['first_name'] ) && preg_match( '/^[a-z]{2,20}$/i', string_validation( $_POST['first_name'] ) ) ) {
                $first_name = string_validation($_POST['first_name']); 
            } else {
                $message[] = "<div class='alert alert-warning'>first_name</div>";
            }

            if( isset( $_POST['last_name'] ) && preg_match('/[a-z]{2,20}$/i', string_validation( $_POST['last_name'] ) ) ) {
                $last_name = string_validation( $_POST['last_name'] );
            } else {
                $message[] = "<div class='alert alert-warning'>last_name</div>";
            }

            if( isset( $_POST['email'] ) && preg_match('/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i', string_validation( $_POST['email'] ) ) ) {
                $email = string_validation( $_POST['email'] );
            } else {
                $message[] = "<div class='alert alert-warning'>email</div>";
            }

            if( isset( $_POST['phone'] ) && preg_match('/^[0-9]{5,20}$/', string_validation( $_POST['phone'] ) ) ) {
                $phone = string_validation( $_POST['phone'] );
            } else {
                $message[] = "<div class='alert alert-warning'>phone</div>";
            }

            $permision = $_POST['permision'];

            if( empty( $message ) ) { 
                $query = "SELECT * FROM users WHERE user_name = '$username'";
                $r = mysqli_query( $dbc, $query ); confirm_query( $r, $query );
                if( mysqli_num_rows( $r ) == 0 ) {
                    $stmt = mysqli_prepare($dbc, "INSERT INTO users( user_name, pass, first_name, last_name, email, phone, permision) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "sssssii", $username, $pass, $first_name, $last_name, $email, $phone, $permision);
                    if(  mysqli_stmt_execute( $stmt ) ) {
                        mysqli_stmt_close($stmt);
                        $new_id = mysqli_insert_id( $dbc );
                        $message[] = "<div class='alert alert-success'>Add user success</div>";
                    } else {
                        $message[] = "<div class='alert alert-warning'>Add user false</div>";
                    }
                } else {
                    $message[] = "<div class='alert alert-warning'>This account already exists . Please enter another account.</div>";
                }
            }
        }
    }
    $avatar_profile = get_avatar_profile( "" );
?>

<!--main-->
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Add User Account
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
                <form class="needs-validation" method="post" novalidate>
                    <div class="position-relative row form-group">
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10"><input name="username"  placeholder="Username" type="text" class="form-control" value="<?php if( isset( $username ) ) echo $username ?>"></div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10"><input name="password"  placeholder="Password" type="password" class="form-control"></div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-2 col-form-label">Re-Password</label>
                        <div class="col-sm-10"><input name="re_password"  placeholder="Re-Password" type="password" class="form-control"></div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-2 col-form-label">First name</label>
                        <div class="col-sm-10"><input name="first_name"  placeholder="First name" type="text" class="form-control" value="<?php if( isset( $first_name ) ) echo $first_name ?>"></div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-2 col-form-label">Last name</label>
                        <div class="col-sm-10"><input name="last_name"  placeholder="Last name" type="text" class="form-control" value="<?php if( isset( $last_name ) ) echo $last_name ?>"></div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10"><input name="email"  placeholder="Email" type="text" class="form-control" required value="<?php if( isset( $email ) ) echo $email ?>"></div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10"><input name="phone"  placeholder="0000000000" type="tel" class="form-control" value="<?php if( isset( $phone ) ) echo $phone ?>"></div>
                    </div>
                    <div class="position-relative row form-group">
                        <label class="col-sm-2 col-form-label">Permision</label>
                        <div class="col-sm-10">
                            <select name="permision" id="permision" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="position-relative row form-check">
                        <input type="submit" name="add_user" value="Add" class="btn-info btn submit-user-info">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 card">
        <div class="card-body d-flex align-items-center justify-content-center">
            <div class="app-header__logo" style="width: auto;"> <div class="logo-src"></div> </div>
        </div>
    </div>
</div>
<?php include('templates/footer.admin.tpl.php') ?>