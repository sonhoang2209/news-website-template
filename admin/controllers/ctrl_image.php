<?php
    include('../../define.php');
    include('../../includes/functions.php');
?>
<?php
    $image = $_FILES['visual_image'];
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if( isset($image) ) {
            $tmp = explode( '.' , $image['name'] );
            $ext = end($tmp);
            $renamed = uniqid(rand(), true).'.'."$ext";
            if(move_uploaded_file($image['tmp_name'], ROOT . "images/products/" . $renamed) && setcookie('add_image_pro', $renamed)) {
                echo $renamed;
            } else {
                echo "false";
            }
		}
	} 
    
?>