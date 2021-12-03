<?php
    include('../../define.php');
    include('../../includes/functions.php');
?>
<?php
    $image = $_FILES['file'];
    $post_id = $_POST['id'];
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if( isset($image) ) {
			$message = array();

            $tmp = explode( '.' , $image['name'] );
            $ext = end($tmp);
            $renamed = uniqid(rand(), true).'.'."$ext";
            if(!move_uploaded_file($image['tmp_name'], ROOT . "images/products/" . $renamed)) {
                $message[] = "<div class='alert alert-warning'>Server problem</div>";
            } else {
                echo "yes, it is done";
            }
		}
	} 

	if( empty($message) ) {
		// Update cSDL
		$q = "UPDATE posts SET product_visual = '{$renamed}' WHERE product_id = {$post_id} LIMIT 1";
		$r = mysqli_query($dbc, $q); confirm_query($r, $q);

		if(mysqli_affected_rows($dbc) > 0) {
			echo 'yes';
		}
	}
	if(!empty($message)) echo $message;
?>