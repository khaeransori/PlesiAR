<?php
	include	'include/config.php';
	
	$name 			= $_POST['name'];
	$description 	= $_POST['desc'];
	$latitude 		= $_POST['lat'];
	$longitude 		= $_POST['lon'];
	$status 	 	= 'hidden';

	if (!empty($_FILES["file"]["tmp_name"])) {
		$folder 	= "upload/"; //tempat menyimpan file

	    $ext 		= $_FILES['file']['type'];
	    if($ext=="image/jpeg" || $ext=="image/jpg" || $ext=="image/gif" || $ext=="image/x-png")
	    {           
	        $path_parts 	= pathinfo($_FILES['file']['name']);
	    	$encrypted_name	= md5(date("Y-m-d H:i:s") . $_FILES['file']['name']);
	    	$new_name 		= $encrypted_name . '.' . $path_parts['extension'];
	        $gambar 		= $folder . $encrypted_name . '.' . $path_parts['extension'];
	        if (move_uploaded_file($_FILES['file']['tmp_name'], $gambar)) {
	            $query 	= "INSERT INTO poi (name, description, latitude, longitude, status, image) values ('$name', '$description', '$latitude', '$longitude', '$status', '$new_name')";
	        } else {
	        	echo 0;
				exit();
	        }
	   } else {
	   		echo 0;
			exit();
	   }
	} else {
		$query 	= "INSERT INTO poi (name, description, latitude, longitude, status) values ('$name', '$description', '$latitude', '$longitude', '$status')";
	}

	$result = mysql_query($query);

	if ($result) {
		echo 1;
		exit();
	} else {
		echo 0;
		exit();
	}
?>