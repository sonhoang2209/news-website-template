<?php
    include('../define.php');
    include('../includes/functions.php');
    if( $user_logged_in = get_current_user_cookie() ) {

    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Amethysta&family=Dosis:wght@200&family=Nunito:wght@300;400&display=swap" rel="stylesheet">
    <title>Login</title>
    <link href="assets/css/admin.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="bg_user_form">
            <img src="assets/images/bg-login.jpg">
        </div>
        <div class="overlay-font form-user">
            <div class="form-user-inner">
                <form method="POST">
                    <?php
                        if( isset( $_COOKIE['user_logged_in'] ) ){
                            $avatar = get_avatar();
                            ?>
                            <div class="avatar">
                                <img src="<?php echo $avatar ?>" />
                                <div class="form-group">
                                    <label><h3><?php echo $user_logged_in['full_name'] ?></h3></label>
                                    <input type="text" name="username" class="form-field" value="<?php echo $user_logged_in['user_name'] ?>" readonly>
                                </div>
                            </div>
                            
                            <?php
                        }
                        if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                            if( isset( $_POST['login'] ) ){
                                $message = array();
                                $preg_match_email = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
                                if( isset( $_POST['username'] ) && preg_match( '/^[a-z0-9]{2,20}$/i', string_validation( $_POST['username'] ) ) ) {
                                    $username = string_validation($_POST['username']); 
                                } else {
                                    $message[] = "<div class='error'>username</div>";
                                }
                                
                                // Validate password
                                if( isset( $_POST['password']) && preg_match('/[a-z0-9]{2,20}$/', string_validation( $_POST['password'] ) ) ) {
                                    $pass = string_validation( $_POST['password'] );
                                } else {
                                    $message[] = "<div class='error'>password</div>";
                                }
                                if( empty($message) ) {
                                    
                                    // Bat dau truy van CSDL de lay thong tin nguoi dung
                                    $query = "SELECT * FROM users WHERE user_name = '$username' and pass = '". md5($pass) ."'";
                                    $r = mysqli_query( $dbc, $query ); confirm_query( $r, $query );
                                    if( mysqli_num_rows( $r ) == 1 ) {
                                        $row = mysqli_fetch_array( $r );
                                        $_SESSION['user_id'] = $row['user_id'];
                                        $_SESSION['full_name'] = $row['first_name'] . ' ' . $row['last_name'];
                                        setcookie('user_logged_in', json_encode([
                                            'user_name'   => $row['user_name'],
                                            'full_name' => $row['first_name'] . ' ' . $row['last_name'],
                                            'avatar'    => $row['avatar']
                                        ]), time() + 3600,'/');
                                        redirect_to();
                                    } else {
                                        $message[] = "<div class='error'>The username or password do not match those on file. Or you have not activated your account.</div>";
                                    }
                                }
                            }
                        }
                        if( ! empty( $message ) ) var_dump( $message ) ;
                        if( ! isset( $_COOKIE['user_logged_in'] ) ) {
                            ?>
                                <div class="form-group">
                                    <label>username</label>
                                    <input type="text" name="username" class="form-field">
                                </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <label>password</label>
                        <input type="password" name="password" class="form-field">
                    </div>
                    <input type="submit" name="login" value="Log in">
                    <?php 
                        if( isset( $_COOKIE['user_logged_in'] ) ) {
                            ?>
                                <input type="submit" name="another_account" value="Log in with another account">
                            <?php
                        }
                    ?>
                    
                </form>
                <div class="forgot"><a href="#">forgot password?</a></div>
            </div>
        </div>
    </div>
</body>
</html>