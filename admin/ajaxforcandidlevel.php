<?php

include 'includes/connect.php';

if(isset($_POST["action"])){
$output1 = '';
$output2 = '';
if($_POST["action"] == "level"){
	$query = "SELECT Yearlevel from tbl_level where Level = '".$_POST["query"]."' group by Yearlevel";
	$result = mysqli_query($mysqli, $query);
	$output1 .= '<option>Choose Year level</option>';
	while($row = mysqli_fetch_array($result)){
		$output1 .= '<option>'.$row['Yearlevel'].'</option>';
	}
}
if($_POST["action"] == "yearlevel"){
	$query = "SELECT Program from tbl_level where Yearlevel = '".$_POST["query"]."' group by Program";
	$result = mysqli_query($mysqli, $query);
	$output2 .= '<option>Choose Program</option>';
	while($row = mysqli_fetch_array($result)){
		$output2 .= '<option>'.$row['Program'].'</option>';
	}
}
echo $output1;
echo $output2;
}
?>