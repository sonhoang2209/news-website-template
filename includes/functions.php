<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
define('LIVE', FALSE);

    function string_validation( $string ) {
        $string = trim( $string );// remove space
        $string = stripslashes( $string );// remove \
        $string = htmlspecialchars( $string );// disable html tag
        return $string;
    }

    function confirm_query($result, $query) {
        global $dbc;
        if(!$result && ! LIVE) {
            die("Query {$query} \n<br/> MySQL Error: " .mysqli_error($dbc));
        } 
    }    

    function id_validation() {
        if( isset( $_GET['id'] ) && filter_var( trim( $_GET['id'] ), FILTER_VALIDATE_INT ) ) {
            return trim( $_GET['id'] );
        }
        return false;
    }

    function redirect_to( $base_url = ADMIN_URL , $page = 'index.php' ) {
        $url = $base_url . $page;
        echo '<script>window.location.href = "'.$url.'";</script>';
        exit();
    }

    function is_user_logged_in() {
        $user_info = get_current_user_info();
        if ( ! $user_info ) 
            return false;

        return true;
    }

    function get_user_by_id( $id ) {
        global $dbc;
        // Truy xuat csdl de hien thi thong tin nguoi dung
        $query = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $dbc->prepare( $query);
        $stmt->bind_param("i", $id); 
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $output = $result->fetch_all(MYSQLI_ASSOC); // fetch the data 
        return array_shift( $output );
    }

    function get_post_by_id( $id ) {
        global $dbc;
        $query = "SELECT * FROM posts WHERE product_id = ?";
        $stmt = $dbc->prepare( $query);
        $stmt->bind_param("i", $id); 
        $stmt->execute();
        $result = $stmt->get_result();
        $output = $result->fetch_all(MYSQLI_ASSOC);
        return array_shift( $output );
    }
    
    function get_current_user_info() {
        if( ! isset( $_SESSION['user_id'] ) )
            return false;
        
        return array(
            'user_id'   => $_SESSION['user_id'],
            'full_name' => $_SESSION['full_name']
        );
    }

    function get_current_user_cookie() {
        if( ! isset( $_COOKIE['user_logged_in'] ) )
            return false;

        return json_decode( $_COOKIE['user_logged_in'], true );
    }

    function get_avatar() {
        if( ! get_current_user_cookie() )
            return false;
        
        $info = get_current_user_cookie();

        if( $info && $info['avatar'] !== null ) {
            $avatar = IMAGES . 'avatars/' . $info['avatar'];
        } else {
            $avatar = IMAGES . 'avatars/' . 'default-avatar.jpg';
        }
        return $avatar;
    }

    function get_avatar_profile( $avatar ) {
        if( $avatar != null ) {
            $avatar = IMAGES . 'avatars/' . $avatar;
        } else {
            $avatar = IMAGES . 'avatars/' . 'default-avatar.jpg';
        }
        return $avatar;
    }

    function form_message( $message ) {
        if( empty( $message ) )   // count()
            return;
        
        foreach( $message as $mess ) {
            echo $mess;
        }
    }
