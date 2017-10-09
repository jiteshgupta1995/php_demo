<?php
	include("connect.php");
	$data = $_POST["data"];
	$arr = json_decode($data);
	$sql="insert into data(Fields,Physics,Maths,Chemistry,Bio,SST)values('{$arr[0]}','{$arr[1]}','{$arr[2]}','{$arr[3]}','{$arr[4]}','{$arr[5]}');";
	$result = mysqli_query($con,$sql);
	echo "Done";
?>