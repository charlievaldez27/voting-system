<?php

include 'includes/connect.php';

if(isset($_POST["action"])){
$output = '';
$output1 = '';
if($_POST["action"] == "level"){
	$query = "SELECT Category from tbl_ajaxposition where Level = '".$_POST["query"]."' group by Category";
	$result = mysqli_query($mysqli, $query);
	$output .= '<option>Choose Category</option>';
	while($row = mysqli_fetch_array($result)){
		$output .= '<option>'.$row['Category'].'</option>';
	}
}
if($_POST["action"] == "Category"){
	$query = "SELECT Representatives from tbl_ajaxposition where Category = '".$_POST["query"]."' group by Representatives";
	$result = mysqli_query($mysqli, $query);
	$output1 .= '<option></option>';
	while($row = mysqli_fetch_array($result)){
		$output1 .= '<option>'.$row['Representatives'].'</option>';
	}
}
echo $output;
echo $output1;
}
?>
