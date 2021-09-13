<?php

session_start();
include 'includes/connect.php';

$update = false;
$partylistname = "";

if(isset($_POST['submit'])){
	$partylistname = $_POST['partylistname'];
	

	if($mysqli->connect_error){
		die('Connection Failed  : ' .$mysqli->connect_error);
		exit();
	}

	$sql = "SELECT * from tbl_partylist where PartylistName = '$partylistname'";
		$result1 = mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result1) > 0){
			header('location: addparty.php?studentID-already-exist');
			$_SESSION['message'] = "Partylist Name Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		
		}
		else
	{
		$stmt = $mysqli->prepare("insert into tbl_partylist(PartylistName)
			values(?)");
		$stmt->bind_param("s",$partylistname);
		$stmt->execute();
		echo "Partylist Added Successfully...";
		$stmt->close();
		$mysqli->close();

			$_SESSION['message'] = "Partylist Added Successfully...	";
	$_SESSION['msg_type'] = "success";
	 header('location: addparty.php');
	 exit() ;
	}
}

if(isset($_GET['delete'])){
	$PartylistID = $_GET['delete'];
	$mysqli->query("DELETE from tbl_partylist where PartylistID='$PartylistID'") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	 header('location: addparty.php');
	 exit();


}


if (isset($_GET['edit'])) {
	$PartylistID = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_partylist where PartylistID='$PartylistID'") or die ($mysqli->error());
	if(count($result) ==1){
		$row  = $result->fetch_array();
			$PartylistID = $row['PartylistID'];
	$partylistname = $row['PartylistName'];
	

	}
}

if(isset($_POST['update'])){
$PartylistID = $_POST['PartylistID'];
	$partylistname = $_POST['partylistname'];


$mysqli->query("UPDATE tbl_partylist set PartylistName = '$partylistname' where PartylistID='$PartylistID'") or die ($mysqli->error());

$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header('location: addparty.php');
exit();
}


?> 





