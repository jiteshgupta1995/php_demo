<?php
	include("connect.php");
	$data = $_POST["data"];
	$type = $_POST["type"];
	$sql="";
	// echo $type;
	if($type == "markwise"){
		$sql="select * from data where Fields='".$data."';";
	}else{
		$sql="select Fields,".$data." from data;";
	}
	// echo $sql;
	$result = mysqli_query($con,$sql);
	while($row=mysqli_fetch_row($result)){
		if($type == "markwise"){
			echo 'Physics-'.$row[1].".";
			echo 'Maths-'.$row[2].".";
			echo 'Chemistry-'.$row[3].".";
			echo 'Bio-'.$row[4].".";
			echo 'SST-'.$row[5].".";
		}else{
			echo $row[0]."-".$row[1].".";
		}
	}
?>