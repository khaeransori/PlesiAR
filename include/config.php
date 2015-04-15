<?php
	$host 	= "localhost";
	$user 	= "root";
	$pass 	= "";
	$db 	= "plesiar";

	$conn = mysql_connect($host, $user, $pass);
	if (!$conn) die ('Gagal Melakukan Koneksi');
	mysql_select_db($db,$conn) or die ('Database Tidak Diketemukan di Server'); 
?>