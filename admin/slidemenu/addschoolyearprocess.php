<?php

session_start();
include 'includes/connect.php';

$update = false;
$schoolyear = "";

if(isset($_POST['submit'])){
	$schoolyear = $_POST['schoolyear'];
	

	if($mysqli->connect_error){
		die('Connection Failed  : ' .$mysqli->connect_error);
		exit();
	}

	$sql = "SELECT * from tbl_schoolyear where schoolyear = '$schoolyear'";
		$result1 = mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result1) >0){
			header('location: addschoolyear.php?School Year-already-exist');
			$_SESSION['message'] = "School Year Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		
		}
		else
	{
		$stmt = $mysqli->prepare("insert into tbl_schoolyear(schoolyear)
			values(?)");
		$stmt->bind_param("s",$schoolyear);
		$stmt->execute();
		echo "Position Added Successfully...";
		$stmt->close();
		$mysqli->close();

			$_SESSION['message'] = "School Year Added Successfully...	";
	$_SESSION['msg_type'] = "success";
	 header('location: addschoolyear.php');
	 exit() ;
	}
}

if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE from tbl_schoolyear where id='$id'") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	 header('location: addschoolyear.php');
	 exit();


}


if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_schoolyear where id='$id'") or die ($mysqli->error());
	if(count($result) ==1){
		$row  = $result->fetch_array();
			$id = $row['id'];
	$schoolyear = $row['schoolyear'];
	

	}
}

if(isset($_POST['update'])){
$id = $_POST['id'];
	$schoolyear = $_POST['schoolyear'];

$sql = "SELECT * from tbl_schoolyear where schoolyear = '$schoolyear'";
		$result1 = mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result1) >0){
			header('location: addschoolyear.php?School Year-already-exist');
			$_SESSION['message'] = "School Year Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		
		}else{

$mysqli->query("UPDATE tbl_schoolyear set schoolyear = '$schoolyear' where id='$id'") or die ($mysqli->error());

$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header('location: addschoolyear.php');
exit();
}
}

?> 





