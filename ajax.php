<?php
    include('define.php');
    include('includes/functions.php');
?>
<?php
    $image = $_FILES['file'];
    $user_id = $_POST['id'];
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if( isset($image) ) {
			$message = array();

            $tmp = explode( '.' , $image['name'] );
            $ext = end($tmp);
            $renamed = uniqid(rand(), true).'.'."$ext";
            if(!move_uploaded_file($image['tmp_name'], ROOT . "images/avatars/" . $renamed)) {
                $message[] = "<div class='alert alert-warning'>Server problem</div>";
            } else {
                echo "yes, it is done";
            }
		}
        
        if($image['error'] > 0) {
            $message[] = "<div class='alert alert-warning'>The file could not be uploaded because: <strong>";
            // Print the message based on the error
            switch ($_FILES['file']['error']) {
                case 1:
                    $message[] .= "The file exceeds the upload_max_filesize setting in php.ini";
                    break;
                case 2:
                    $message[] .= "The file exceeds the MAX_FILE_SIZE in HTML form";
                    break;
                case 3:
                    $message[] .= "The was partially uploaded";
                    break;
                case 4:
                    $message[] .= "NO file was uploaded";
                    break;
                case 6:
                    $message[] .= "No temporary folder was available";
                    break;
                case 7:
                    $message[] .= "Unable to write to the disk";
                    break;
                case 8:
                    $message[] .= "File upload stopped";
                    break;
                default:
                    $message[] .= "a system error has occured.";
                    break;
            }
            $message[] .= "</strong></div>";
        } 
	} 

	if( empty($message) ) {
		// Update cSDL
		$q = "UPDATE users SET avatar = '{$renamed}' WHERE user_id = {$user_id} LIMIT 1";
		$r = mysqli_query($dbc, $q); confirm_query($r, $q);

		if(mysqli_affected_rows($dbc) > 0) {
			echo 'yes';
		}
	}
	if(!empty($message)) echo $message;
?>