<?php

session_start();
include 'includes/connect.php';

$update = false;
$Positions = "";
$schoolyear = "";

if(isset($_POST['submit'])){
	$Positions = $_POST['Positions'];
	$schoolyear = $_POST['schoolyear'];
	

	if($mysqli->connect_error){
		die('Connection Failed  : ' .$mysqli->connect_error);
		exit();
	}

	$sql = "SELECT * from tbl_position where position = '$Positions'";
		$result1 = mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result1) >0){
			header('location: addposition.php?Position-already-exist');
			$_SESSION['message'] = "Position Name Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		
		}
		else
	{
		$stmt = $mysqli->prepare("insert into tbl_position(position,schoolyear)
			values(?,?)");
		$stmt->bind_param("ss",$Positions,$schoolyear);
		$stmt->execute();
		echo "Position Added Successfully...";
		$stmt->close();
		$mysqli->close();

			$_SESSION['message'] = "Position Added Successfully...	";
	$_SESSION['msg_type'] = "success";
	 header('location: addposition.php');
	 exit() ;
	}
}

if(isset($_GET['delete'])){
	$PositionID = $_GET['delete'];
	$mysqli->query("DELETE from tbl_position where PositionID='$PositionID'") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	 header('location: addposition.php');
	 exit();


}


if (isset($_GET['edit'])) {
	$PositionID = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_position where PositionID='$PositionID'") or die ($mysqli->error());
	if(count($result) ==1){
		$row  = $result->fetch_array();
			$PositionID = $row['PositionID'];
			$schoolyear = $row['schoolyear'];
	$Positions = $row['position'];
	

	}
}

if(isset($_POST['update'])){
$PositionID = $_POST['PositionID'];
	$Positions = $_POST['Positions'];
	$schoolyear = $_POST['schoolyear'];


$mysqli->query("UPDATE tbl_position set position = '$Positions',schoolyear = '$schoolyear' where POsitionID='$PositionID'") or die ($mysqli->error());

$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header('location: addposition.php');
exit();
}


?> 





