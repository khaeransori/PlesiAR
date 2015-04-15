<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-type: application/json");

	include 'include/config.php';

	$query 		= "SELECT * FROM poi WHERE status = 'visible' ORDER BY id DESC";
	$result 	= mysql_query($query);

	while($row = mysql_fetch_array($result)){
		$return[] = array(
			"id" => $row['id'],
			"longitude" => $row['longitude'],
			"latitude" => $row['latitude'],
			"description" => $row['description'],
			"name" => $row['name'],
			"image" => $row['image']
		);
	}

	echo json_encode($return);
?>