<?php
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
    	$destination_path = getcwd().DIRECTORY_SEPARATOR;
		$target_path = $destination_path.basename( $_FILES["file"]["name"]);
		move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
		echo $_FILES["file"]["name"];
    }
?>