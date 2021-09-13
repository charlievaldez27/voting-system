<?php

session_start();


$mysqli = new mysqli('localhost','root','','db_ssc_voting') or die (mysqli_error($mysqli));
$Studentid=0;
$update = false;
$Studentid ="";
	$Fullname = "";
	$Program = "";
	$Gender ="";
	$email = "";
	$yearlevel = "";


if(isset($_POST['submit'])){
	$Studentid = $_POST['Studentid'];
	$Fullname = $_POST['Fullname'];
	$Program = $_POST['Program'];
	$Gender = $_POST['Gender'];
	$email = $_POST['email'];
	$yearlevel = $_POST['yearlevel'];

	if($mysqli->connect_error){
		die('Connection Failed  : ' .$mysqli->connect_error);
		exit();
	}
		$sql = "SELECT * from tbl_addvoters where studentID = '$Studentid'";
		$sql1 = "SELECT * from tbl_addvoters where email = '$email'";
		$result = mysqli_query($mysqli,$sql);
		$result1 = mysqli_query($mysqli,$sql1);
		if(mysqli_num_rows($result) > 0){
			header('location: addvoters.php?studentID-already-exist');
			$_SESSION['message'] = "Student ID Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		
		}
		elseif(mysqli_num_rows($result1) > 0){
			header('location: addvoters.php?email-already-exist');
			$_SESSION['message'] = "Email Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		}
	
	else
	{
		$stmt = $mysqli->prepare("insert into tbl_addvoters(studentID, Fullname,Program, Gender, email, yearlevel)
			values(?,?,?,?,?,?)");
		$stmt->bind_param("isssss",$Studentid,$Fullname,$Program,$Gender,$email,$yearlevel);
		$stmt->execute();
		echo "Registration Successfully...";
		$stmt->close();
		$mysqli->close();

			$_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";
	 header('location: addvoters.php');
	 exit() ;
	}
}
// if(isset($_POST['submit'])){
// 	$Studentid = $_POST['Studentid'];
// 	$name = $_POST['Fullname'];
// 	$Gender = $_POST['Gender'];
// 	$email = $_POST['email'];
// 	$yearlevel = $_POST['yearlevel'];

// 	$_SESSION['message'] = "Record has been saved!";
// 	$_SESSION['msg_type'] = "success";

// 	$mysqli->query("INSERT INTO tbl_addvoters (studentID,Fullname,Gender,email,yearlevel) values ('$Studentid','$name','$Gender','$email','$yearlevel')") or die ($mysqli->error);

// 	$_SESSION['message'] = "Record has been saved!";
// 	$_SESSION['msg_type'] = "success";
// 	 header('location: addvoters.php');
// 	 exit() ;


// }

if(isset($_GET['delete'])){
	$Studentid = $_GET['delete'];
	$mysqli->query("DELETE from tbl_addvoters where studentID='$Studentid'") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	 header('location: addvoters.php');
	 exit();


}

if (isset($_GET['edit'])) {
	$Studentid = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_addvoters where studentID='$Studentid'") or die ($mysqli->error());
	if(count($result) ==1){
		$row  = $result->fetch_array();
			$Studentid = $row['studentID'];
	$Fullname = $row['Fullname'];
	$Program = $row['Program'];
	$Gender = $row['Gender'];
	$email = $row['email'];
	$yearlevel = $row['yearlevel'];

	}
}

if(isset($_POST['update'])){
$Studentid = $_POST['id'];
	$name = $_POST['Fullname'];
	$Program = $_POST['Program'];
	$Gender = $_POST['Gender'];
	$email = $_POST['email'];
	$yearlevel = $_POST['yearlevel'];


$mysqli->query("UPDATE tbl_addvoters set Fullname = '$name',Program = '$Program',Gender = '$Gender',email = '$email',yearlevel = '$yearlevel' where studentID='$Studentid'") or die ($mysqli->error());

$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header('location: addvoters.php');
exit();
}


?> 