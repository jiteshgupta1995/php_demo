<?php
	$database="data";
	$con=mysqli_connect("localhost","root","",$database);
	if(!$con){
		die('Could not connect'.mysql_error());
	}
?>