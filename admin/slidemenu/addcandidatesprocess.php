<?php


session_start();
include 'includes/connect.php';


$id="";
$update = false;
$studentid ="";
	$fullname = "";
	$course = "";
	$year = "";
	$partylist ="";
	$position = "";
	$schoolyear="";



if(isset($_POST['submit'])){
	$schoolyear = $_POST['schoolyear'];
	$partylist = $_POST['partylist'];
	$position = $_POST['position'];
	$studentid = $_POST['studentid'];
	$fullname = $_POST['fullname'];
	$course = $_POST['course'];
	$year = $_POST['year'];	

	if($mysqli->connect_error){
		die('Connection Failed  : ' .$mysqli->connect_error);
		exit();
	}

	

	$sql = "SELECT * from tbl_nominees where studentid = '$studentid'";
		$result = mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result) > 0){
			header('location: addcandidates.php?student ID already exist');
			$_SESSION['message'] = "Student ID Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		
		}
		$sql1 = ("SELECT * from tbl_nominees where position = '$position' and partylist = '$partylist'");
		$result1 = mysqli_query($mysqli,$sql1);
		 if (mysqli_num_rows($result1) !=0) {
			header('location: addcandidates.php?position already taken');
			$_SESSION['message'] = "Position already taken!";
			$_SESSION['msg_type'] = "danger";
			exit();
		}
		else
	{
		$stmt = $mysqli->prepare("insert into tbl_nominees(schoolyear,partylist,position,studentid,fullname,course,year)
			values(?,?,?,?,?,?,?)");
		$stmt->bind_param("sssisss",$schoolyear,$partylist,$position,$studentid,$fullname,$course,$year);
		$stmt->execute();
		echo "Candidate Added Successfully...";
		$stmt->close();
		$mysqli->close();

			$_SESSION['message'] = "Candidate Added Successfully...	";
	$_SESSION['msg_type'] = "success";
	 header('location: addcandidates.php');
	 exit() ;
	}

}




if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE from tbl_nominees where id='$id'") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	 header('location: addcandidates.php');
	 exit();


}


if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_nominees where id='$id'") or die ($mysqli->error());
	if(count($result) ==1){
		$row  = $result->fetch_array();
		$id=$row['id'];
		$schoolyear = $row['schoolyear'];
			$studentid = $row['studentid'];
	$partylist = $row['partylist'];
	$position = $row['position'];
	$studentid = $row['studentid'];
	$fullname = $row['fullname'];
	$course = $row['course'];
	$year = $row['year'];
	
	

	}
}

if(isset($_POST['update'])){
$id = $_POST['id'];
$schoolyear = $_POST['schoolyear'];
$partylist = $_POST['partylist'];
	$position = $_POST['position'];
	$studentid = $_POST['studentid'];
	$fullname = $_POST['fullname']; 
	$course = $_POST['course'];
	$year = $_POST['year'];

$mysqli->query("DELETE from tbl_nominees where id='$id'") or die($mysqli->error());
$sql1 = ("SELECT * from tbl_nominees where position = '$position' and partylist = '$partylist'");
		$result1 = mysqli_query($mysqli,$sql1);
		 if (mysqli_num_rows($result1) !=0) {
			header('location: addcandidates.php? already exist');
			$_SESSION['message'] = " already exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		}

	else
	{
		$stmt = $mysqli->prepare("insert into tbl_nominees(schoolyear,partylist,position,studentid,fullname,course,year)
			values(?,?,?,?,?,?,?)");
		$stmt->bind_param("sssisss",$schoolyear,$partylist,$position,$studentid,$fullname,$course,$year);
		$stmt->execute();
		//echo "Candidate Added Successfully...";
		$stmt->close();
		$mysqli->close();


$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header('location: addcandidates.php');
exit();
}
}
?>