<?php 
session_start();
include '../admin/includes/connect.php';


	$id="";
	$update = false;
	$studentid ="";
	$Firstname = "";
	$Lastname = "";
	$MI = "";
	$Suffix = "";
	$course = "";
	$Level = "";
	$yearlevel = "";
	$partylist ="";
	$position = "";
	$schoolyear="";
	$CanProfile = "";
	$Status ="";
	$error = "";
	$image= "";



if(isset($_POST['submit'])){
	$schoolyear = $_POST['schoolyear'];
	$partylist = $_SESSION['PartylistName'];
	$position = $_POST['position'];
	$studentid = $_POST['studentid'];
	$Firstname = $_POST['Firstname'];
	$Lastname = $_POST['Lastname'];
	$MI = $_POST['MI'];
	$Suffix = $_POST['Suffix'];
	$Level = $_POST['Level'];
	$course = $_POST['course'];
	$yearlevel = $_POST['yearlevel'];	
	$CanProfile = $_POST['CanProfile'];	
	$Status = $_POST['Status'];

	if($mysqli->connect_error){
		die('Connection Failed  : ' .$mysqli->connect_error);
		exit();
	}

	

	$sql = "SELECT * from tbl_nominees where studentid = '$studentid'";
		$result = mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result) > 0){
			header('location: mycandidates.php?student ID already exist');
			$_SESSION['message'] = "Student ID Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		
		}
		$sql1 = ("SELECT * from tbl_nominees where position = '$position' and partylist = '$partylist' and Level = '$Level' and schoolyear = '$schoolyear' ");
		$result1 = mysqli_query($mysqli,$sql1);
		 if (mysqli_num_rows($result1) !=0) {
			header('location: mycandidates.php?position already taken');
			$_SESSION['message'] = "Position already taken!";
			$_SESSION['msg_type'] = "danger";
			exit();
		}
		else
	{

		 $target_dir = "image/";
   		 $target_file = $target_dir . basename($_FILES["image"]["name"]);  		 
   		 $ext = "../";
   		 move_uploaded_file($_FILES["image"]["tmp_name"], $ext.$target_file);



		$stmt = $mysqli->prepare("insert into tbl_nominees(schoolyear,Level,partylist,position,studentid,Firstname,Lastname,MI,Suffix,course,year,Cprofile,Status,C_image)
			values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssssisssssssss",$schoolyear,$Level,$partylist,$position,$studentid,$Firstname,$Lastname,$MI,$Suffix,$course,$yearlevel,$CanProfile,$Status,$target_file);
		$stmt->execute();
		//echo "Candidate Added Successfully...";
		$stmt->close();
		$mysqli->close();

	$_SESSION['message'] = "Candidate Added Successfully...	";
	$_SESSION['msg_type'] = "success";
	 header('location: mycandidates.php');
	 exit() ;
	}

}




if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE from tbl_nominees where id='$id'") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";
	 header('location: mycandidates.php');
	 exit();


}

if(isset($_GET['archive'])){
	$id = $_GET['archive'];
	$mysqli->query("UPDATE tbl_nominees set Status='Inactive' where id='$id'") or die($mysqli->error());

	$_SESSION['message'] = "Record archived!";
	$_SESSION['msg_type'] = "warning";
	 header('location: mycandidates.php');
	 exit();


}


if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_nominees where id='$id'") or die ($mysqli->error());
	if(mysqli_num_rows($result) ==1){
		$row  = $result->fetch_array();
		$id=$row['id'];
		$schoolyear = $row['schoolyear'];
			$studentid = $row['studentid'];
	//$partylist = $row['partylist'];
	$position = $row['position'];
	$studentid = $row['studentid'];
	$Firstname = $row['Firstname'];
	$Lastname = $row['Lastname'];
	$MI = $row['MI'];
	$Suffix = $row['Suffix'];
	$LeveL = $row['Level'];
	$course = $row['course'];
	$year = $row['year'];
	$CanProfile = $row['Cprofile'];
	$Status = $row['Status'];
	$image = $row['C_image'];
	
	

	}

	if(isset($_POST['upload'])){

 		$target_dir = "image/";
   		 $target_file = $target_dir . basename($_FILES["image"]["name"]);
   		 $ext = "../";
   		 move_uploaded_file($_FILES["image"]["tmp_name"], $ext.$target_file);

			$query="UPDATE tbl_nominees set C_image = '$target_file' where id = '$id'";
		    $ex=mysqli_query($mysqli,$query);
		    if($ex){

		    		$_SESSION['message'] = "Image uploaded...	";
					$_SESSION['msg_type'] = "success";
		      
		    }
		    else{
		        $_SESSION['message'] = "Image uploading failed.. Please try again	";
					$_SESSION['msg_type'] = "success";
		    }
		}
}		

if(isset($_POST['update'])){
$id = $_POST['id'];
$schoolyear = $_POST['schoolyear'];
$partylist = $_SESSION['PartylistName'];
	$position = $_POST['position'];
	$studentid = $_POST['studentid'];
	$Firstname = $_POST['Firstname'];
	$Lastname = $_POST['Lastname'];
	$MI = $_POST['MI'];
	$Suffix = $_POST['Suffix'];
	$Level = $_POST['Level'];
	$course = $_POST['course'];
	$yearlevel = $_POST['yearlevel'];
	$CanProfile = $_POST['CanProfile'];
	$Status = $_POST['Status'];
	$image = $_POST['image'];



$sql1 = ("SELECT * from tbl_nominees where position = '$position' and partylist = '$partylist' and Level = '$Level' and schoolyear = '$schoolyear' and id != '$id'");
		$result1 = mysqli_query($mysqli,$sql1);
		 if (mysqli_num_rows($result1) !=0) {
			header('location: mycandidates.php?position already exist in this partylist..');
			$_SESSION['message'] = "Position already taken!";
			$_SESSION['msg_type'] = "danger";
			exit();
		}

	else
	{

// $mysqli->query("DELETE from tbl_nominees where id='$id'") or die($mysqli->error());



// 		$stmt = $mysqli->prepare("insert into tbl_nominees(id,schoolyear,Level,partylist,position,studentid,Firstname,Lastname,MI,Suffix,course,year,Cprofile,Status,C_image)
// 		values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
// 		$stmt->bind_param("issssisssssssss",$id,$schoolyear,$Level,$partylist,$position,$studentid,$Firstname,$Lastname,$MI,$Suffix,$course,$yearlevel,$CanProfile,$Status,$image);
// 		$stmt->execute();
// 		//echo "Candidate Added Successfully...";
// 		$stmt->close();
// 		$mysqli->close();
		
$mysqli->query("UPDATE tbl_nominees set schoolyear = '$schoolyear',Level = '$Level',partylist = '$partylist',position = '$position',studentid = '$studentid',Firstname = '$Firstname',Lastname = '$Lastname',MI = '$MI',Suffix = '$Suffix',course = '$course',year = '$yearlevel',Cprofile = '$CanProfile',Status = '$Status' where id = '$id'") or die ($mysqli->error());

$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header('location: mycandidates.php');
exit();
}
}


						if (isset($_SESSION['PartylistID'])){

			

			
			require("../includes/pdo.php");
				$sql = "SELECT PartylistName from tbl_partylist where  Status = 'Active'";
				$sql1 = "SELECT position from tbl_position where Status = 'Active'";
				//$sql2 = "SELECT yearlevel from tbl_yearlevel";
				 $sql3= "SELECT schoolyear from tbl_schoolyear where Status = 'Active'";
				// $sql4 = "SELECT program from tbl_program";

				try{ //for partylist dropdown
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$results = $stmt->fetchAll();
					//for positions dropdown
					$stmt1 = $conn->prepare($sql1);
					$stmt1->execute();
					$results1 = $stmt1->fetchAll();
					//for yearlevel
					// $stmt2 = $conn->prepare($sql2);
					// $stmt2->execute();
					// $results2 = $stmt2->fetchAll();

					$stmt3 = $conn->prepare($sql3);
					$stmt3->execute();
					$results3 = $stmt3->fetchAll();

					// $stmt4 = $conn->prepare($sql4);
					// $stmt4->execute();
					// $results4 = $stmt4->fetchAll();

				}catch(Exception $ex){
						echo ($ex -> getMessage());
				}
			?>

	 <?php
    //ajax for shs/tertiary

    $Level ='';
    $query = "SELECT Level from tbl_level group by Level order by Level ASC";
    $result = mysqli_query($mysqli, $query);
    while ($row = mysqli_fetch_array($result)) {
    	$Level .= '<option value = "'.$row['Level'].'">'.$row['Level'].'</option>';
    }
    ?>



 <!DOCTYPE html>
<html>
<head>
	<title>My Candidates</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<script src="http://code.jquery.com/jquery-3.4.1.js" ></script>
	<link rel="stylesheet" type="text/css" href="../admin/fontawesome/css/all.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	

	
	<link rel="stylesheet" type="text/css" href="addcandidate5.css">

	  <style>



body{
	margin: 0;
	padding:0;
}

.navbar{

  position: fixed;
    padding:20px 20px 20px 30px;
  margin: 0;
  z-index: 8;
  width: auto;
  height: 50px;
  background: #ffc107;
  color: #025baa;
  border-bottom: 1px solid #135190;
}


.navbar-dark{
  width: 100%;
  height: 80px;
}

.navbar-dark .navbar-nav .nav-item .nav-link{
  color: #025baa
}

.nav-item{
  font-weight: 600;
  font-size: 13px;
  text-transform: uppercase;
  padding: 5px;

}

.navbar-dark .navbar-nav .nav-item .nav-link:hover{
  background: #d39e00;
  color:  #ccc;
  border-radius: 5px;
  transition: .8s;
}

.hovers{
	background-color: #d39e00;
	color:  #025baa;
	border-radius: 5px;
}

#logo {
	float: left;
	margin: 0;
	width: 80px;
	height: 50px;

}

#header nav ul li a{
	color: #025baa;
	padding: 10px;
}

ul li a{
	background: #ffc107;
	padding: 10px;
}

#navbarSupportedContent{
	color: black;
}


.main{
	position: relative;
	background: white;
	min-height: 100vh;
	background-size: cover;
	background-position: center;
	padding: 150px 0 200px;
}
	


.main h1{
	color: #023367;
	text-transform: uppercase;
	padding-left: 145px;
	font-size: 20px;
}



.info{	 
		
		color:black;
}
.candidateinfo{
	color:#858585;
	border: 1px solid #117a8b;
	border-radius: 3px;
	width:200px;
	margin: 4px;
	padding: 4px;
	width: 400px; 
	text-align: left;
	background: transparent;
}

.buttondes{
	padding: 5px 30px 5px 30px;
}

.center{
text-align: center;
}

.container1{
	height: 50vh;
	width: 1230px;
	max-height: 470px;
	padding-bottom: 40px;
	margin-left: 50px;
	overflow-y: auto;
	border-collapse: collapse;
}
table thead th,table tbody td{
	padding: 3px 7px 3px 7px;
	text-align: center;
	border: 1px solid #ccc;
	border-radius: 5px;

}
table thead th{
	background: #0a57a9;
	color: white;
	text-transform: uppercase;
	position: sticky;
	top: -1px;
	font-size: 13px;
	border-radius: 5px;
	padding:5px 20px 5px 20px;

}


::-webkit-scrollbar {
  width: 10px;
}


::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 5px;
}
 

::-webkit-scrollbar-thumb {
  background: #025baa; 
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: #023767; 
}
.asterisk_input::after {
content:"*"; 
color: #e32;
position: absolute; 
margin: -5px 0px 0px -10px; 
font-size: large; 
padding: 0 5px 0 0; }
</style>

</head>



<body>
	


				<nav class="navbar navbar-expand-sm navbar-dark ">
					
				<!-- 		<a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->

						   <p style=" padding-top: 17px; font-size: 20px; color: #025baa;"><strong>STI COLLEGE TANAUAN <br>
                            SSC VOTING SYSTEM</strong></p>


						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						 aria-controls="navbarSupportedContent" aria-expanded ="false" aria-label="Toggle navigation">
						 	<span class="navbar-toggler-icon"></span>
						 </button>

						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto">

<!-- 
								<li class="nav-item">
									<a href="home.php" class="nav-link"><i class='fas fa-home' style='font-size:13px;color:#015baa;margin: 4px'></i> home	</a>
									</li>

								<li class="nav-item ">
										<a href="addvoters.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Voters</a>

									<li class="nav-item">
										<a href="addparty.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Partylist</a>
									</li>

									</li>

									<li class="nav-item">
										<a href="addschoolyear.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Schoolyear</a>
									</li>

									<li class="nav-item">
										<a href="addposition.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Position</a>
									</li>

									<li class="nav-item">
										<a href="addcandidates.php" class="nav-link hovers"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Candidates</a>
									</li>
	 
									<li class="nav-item">
										<a href="viewresults.php" class="nav-link"><i class='fas fa-poll-h' style='font-size:13px;color:#015baa;margin: 4px'></i>View Result</a>
									</li> -->

									<li class="nav-item">
										<a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt" style='font-size:13px;color:#015baa;margin: 4px'></i>Logout</a>
									</li>

							
							</ul>
						</div>
					
				</nav>



<section class="main">


		

			<div class="container">

				<div class="row no-gutters">


					<div class="col-sm-6 no-gutters" id="createform">

						<form class="stu-container" action="" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<h1> Add candidates for <?php echo $_SESSION['PartylistName']; ?></h1><br><br>

							<span class="asterisk_input">  </span><label class="info">Choose School Year<br>
								<select name = "schoolyear" class ="candidateinfo" placeholder ="Choose School Year" required>
									<!-- <option disabled selected>Choose Year Level</option>  -->
							<?php
								if($update == true):
							?>
									<option ><?php echo $schoolyear; ?></option>
									<?php
										foreach($results3 as $output)
									{ ?>
						 		<option ><?php echo $output["schoolyear"]; ?></option>
							<?php } ?>





							
									<?php else: ?>
										
									<?php
										foreach($results3 as $output)
									{ ?>
										
						 		<option ><?php echo $output["schoolyear"]; ?></option>
							<?php } ?>
							<?php endif; ?>
								</select>
							</label> 
							<br>

							<span class="asterisk_input">  </span><label class="infogender"style="color: black">Choose Level<br>
								<select name = "Level" id = "level" class ="form-control form-control-sm candidateinfo gender action" placeholder ="Choose Level" required>
									<!-- <option disabled selected>Choose Year Level</option>  -->
							<?php
								if($update == true):
							?>
									<option ><?php echo $LeveL; ?></option>
								<?php echo $Level; ?>
									


							
									<?php else: ?>
										<option >Choose Level</option>
							
							<?php echo $Level; ?>
							<?php endif; ?>
								</select>
							</label> <br>



							<!-- <label class="info">Choose Partylist<br>
								<select name = "partylist" class ="candidateinfo" placeholder ="Choose Partylist" required>
									
							<?php
								if($update == true):
							?>
									<option ><?php echo $partylist; ?></option>
									<?php
										foreach($results as $output)
									{ ?>
						 		<option ><?php echo $output["PartylistName"]; ?></option>
							<?php } ?>




									<?php else: ?>
										<option value="" >Choose your party list</option>
									<?php
										foreach($results as $output)
									{ ?>
										
						 		<option ><?php echo $output["PartylistName"]; ?></option>
							<?php } ?>
							<?php endif; ?>
								</select>
							</label>  -->


							<span class="asterisk_input">  </span><label class="info">Choose Position<br>
								<select name = "position" id = "position" class ="candidateinfo" placeholder ="Choose Position" required>
									<!-- <option disabled selected>Choose Year Level</option>  -->
									<?php
								if($update == true):
							?>	
											<option><?php echo $position; ?></option>
											<?php echo $output1; ?>
											<!-- <?php
										foreach($results1 as $output)
									{ ?>
						 		<option ><?php echo $output["position"]; ?></option>
							<?php } ?> -->
									





									<?php else: ?>
										<!-- <option value ="" >Choose position</option>
									<?php
										foreach($results1 as $output)
									{ ?>
										
						 		<option ><?php echo $output["position"]; ?></option>
							<?php } ?> -->
							<option> Choose Position </option>
							<?php endif; ?>
								</select>
							</label> 

							<br><span class="asterisk_input">  </span><label class="info">Choose Year Level<br>
								<select name = "yearlevel" id = "yearlevel" class ="candidateinfo action" placeholder ="Choose Year Level" required>
								<?php
								if($update == true):
							?>	
									<option><?php echo $year; ?></option>
									<?php echo $output1; ?>
									





												<?php else: ?>
									
						 		<option >Choose Yearlevel</option>
							
							<?php endif; ?>
								</select>
							</label> 



							<br><span class="asterisk_input">  </span><label class="info">Choose Program/Course<br>
								<select name = " course" id="program" class ="form-control candidateinfo " placeholder ="Choose Program/Course" required>
									<!-- <option disabled selected>Choose Year Level</option>  -->
							<?php
								if($update == true):
							?>
									<option ><?php echo $course; ?></option>
									<?php echo $output2; ?>
									




							
									<?php else: ?>
									
						 		<option >Choose Program</option>
							
							<?php endif; ?>
								</select>
							</label> 
							
							
							<div >
								<span class="asterisk_input">  </span> <label class="infogender" style="color: black" >Status<br>
								<?php
								if($update == true):
									?>
									<input type="radio" name="Status" value="Active" <?php if($Status == 'Active'){ echo 'checked'; }?>  required>Active<br>
								
							<?php else: ?>
								<input type="radio" name="Status" value="Active"  required>Active<br>
										<?php endif; ?>
								

								<?php
								if($update == true):
									?>
									<input type="radio" name="Status" value="Inactive" <?php if($Status == 'Inactive'){ echo 'checked'; }?>  required>Inactive<br>
								
							<?php else: ?>
								<input type="radio" name="Status" value="Inactive" required>Inactive
								<?php endif; ?>
							</div>

							

							
						</div><!--  end 1st col -->
						<div class="col-sm-6 no-gutters" style="padding-top: 10px" >

							<?php 
							
									if(isset($_SESSION['message'])):

		 						?>

		 							<div style="float: left; background: #ef7070;color: white; width: 300px; " class="alert alert-<?=$_SESSION['msg_type']?> fadeout">

		 							<?php
		 								echo $_SESSION['message'];
		 								unset($_SESSION['message']);
		 							?>
		 							</div>
								<?php endif ?>



								<br><br><br>
								<span class="asterisk_input">  </span><label class="info">Student ID
							<input type="number" pattern="[0-9]+" title="Student id should contain 10 to 14 numbers" maxlength="14" minlength="10"  class = "form-control candidateinfo" name="studentid" value="<?php echo $studentid; ?>" placeholder="Student ID" required></label><br>	

 								<div class="row">
								<div class="col">

							
 							<span class="asterisk_input">  </span><label class="info">First name<br>
							<input type="text" pattern="[a-zA-Z]+([-\,][a-zA-Z]+)?" title="Firstname should contain only letters" class = "form-control form-control-sm candidateinfo" name="Firstname" style="width: 250px" value="<?php echo $Firstname; ?>" placeholder="Firstname" required></label> <br>
								</div>


								<div class="col">
 							<span class="asterisk_input">  </span><label class="info">MI<br>
							<input type="text" pattern="[a-zA-Z]+" title="Middlename should contain only letters" class = "form-control form-control-sm candidateinfo" name="MI" style="width: 100px" value="<?php echo $MI; ?>" placeholder="MI" required></label> <br>
								</div>

								<div class="col">
 							<span class="asterisk_input">  </span><label class="info">Last name<br>
							<input type="text" pattern="[a-zA-Z]+([-\,][a-zA-Z]+)?" title="Lastname should contain only letters" class = "form-control form-control-sm candidateinfo" name="Lastname" style="width: 250px" value="<?php echo $Lastname; ?>" placeholder="Lastname" required></label> <br>
								</div>

								<div class="col">
 							<label class="info">Suffix <br>
							<input type="text" class = "form-control form-control-sm candidateinfo" name="Suffix" style="width: 100px" value="<?php echo $Suffix; ?>" placeholder="Suffix" ></label> <br>
								</div>
							</div>


							<label class="info">Candidate profile <br>
							<textarea name="CanProfile" rows="5" style="width: " class="candidateinfo" cols="40"><?php echo $CanProfile;?></textarea></label><br>

						<?php
								if($update == true){
							?>

							<label >Candidate picture<br>
              				<input type="file" name="image" ><br>
              				<input type="text" hidden name="image" value="<?php echo $image; ?>" required><br>
              				<input type="submit" name="upload" class="btn btn-info" value="Upload new picture"></label><br>
              			<?php } else { ?>

							<span class="asterisk_input">  </span><label >Candidate picture<br>
              				<input type="file" name="image" required></label><br>
              			<?php } ?>

							<!-- 	<label class="info">Course/Program<br>
								<select name="course" value="<?php echo $course; ?>" class ="candidateinfo" placeholder="Program/Course" required>
								
								<option >BSIT</option>
						 		<option >TRM</option>
							</label> <br> -->

							
							<br>
							<?php
								if($update == true):
							?>	
							
							<button type="submit" class="btn btn-info buttondes " name="update">Update</button>
							<a type="submit" class="btn btn  " style="border:1px solid #ccc;margin: 20px; border-radius:10px ; width: 120px " href="addcandidates.php" ="update">Cancel</a>
							<?php else: ?>
								<button type="submit" class="btn btn-primary buttondes" name="submit">Save</button>
							<?php endif; ?>
						</form>
					</div> <!-- end 2nd col -->


				</div><!-- end row -->
</div>




					<div class="col-sm-6 no-gutters " id="createform">

						


						<form class="stu-container" action="" method="POST">
							<h1> </h1><br><br>

								 <div class="input-group" style="width: 400px; line-height: 40px; background: transparent; padding-top: 22px">
 							<input type="text" class="form-control form-control-sm py-2 border-right-0 " name="searched" value="<?php $searched; ?>" placeholder="search by name, position" style="width: 100px; margin-left: 50PX; margin-bottom: 10px;border: none; background-color: #f1f1f1 " ><span class="input-group-append" style="background: transparent; height: 50px;">
 								<div class="input-group-text " style="margin-bottom: 10px; background: white;border: none; background-color: #f1f1f1"><i class="fa fa-search"><button type="" class=" btn btn-outline-secondary" onclick="getFocus()" name="search" style=" border: none;font-family: arial">search</button></i></div></span>
 							<!-- <button type="submit" class=" btn btn-outline-secondary"  name="search">search <i class="fa fa-search"></i></button> -->
 							</div>

							<?php

							
							if (isset($_POST['search'])) {
								$searched = $_POST['searched'];
								$partylist = $_SESSION['PartylistName'];
								$schoolyear = $_SESSION['schoolyear'];

							$results =  $mysqli->query("SELECT * from tbl_nominees where CONCAT(`studentid`, `Firstname`, `Lastname`, `position`, `year`, `schoolyear`) like '%$searched%' where partylist = '$partylist'  and schoolyear= '$schoolyear' order by id DESC") or die($mysqli->error);

							$results1 =  $mysqli->query("SELECT * from tbl_nominees where CONCAT(`studentid`, `Firstname`, `Lastname`, `position`, `year`, `schoolyear`) like '%$searched%' where partylist = '$partylist'  and schoolyear= '$schoolyear' order by id DESC") or die($mysqli->error);
								
							if(mysqli_num_rows($results1) == 0){
								$error =  "<p style = 'color: red'>No record found...<br><a href='addcandidates.php'>click here to continue</a></p> ";
									}

									}
									else {
										$partylist = $_SESSION['PartylistName'];
										$schoolyear = $_SESSION['schoolyear'];
							$results =  $mysqli->query("SELECT * from tbl_nominees where partylist = '$partylist' and schoolyear= '$schoolyear' order by id DESC") or die($mysqli->error);

									}

							?>
									<div class="container1 borders" id = "focus"  >
										<table>
											<thead>
												<tr>
													<th>Image</th>
													<th>First name</th>
													<th>Last name</th>
													<th>Partylist</th>
													<th>Position</th>
													<th>Level</th>
													<th>School Year</th>
													<th>Status</th>
													<th colspan="3">Action</th>
												</tr>
											</thead>
											<?php
												while($row = $results->fetch_assoc()):
											?>
										<tbody>
											<tr>
												<td> <img src= "<?php echo "../".$row['C_image']; ?>"  style="height: 50px; width: 60px; border-radius: 0%; margin-left:  0px;" /> </td>
												<td><?php echo $row['Firstname'] ?></td>
												<td><?php echo $row['Lastname'] ?></td>
												<td><?php echo $row['partylist'] ?></td>
												<td><?php echo $row['position'] ?></td>
												<td><?php echo $row['Level'] ?></td>
												<td><?php echo $row['schoolyear'] ?></td>
												<?php if($row['Status'] == 'Active'){?>
												<td style="color: #04e2b5"><?php echo $row['Status'] ?></td>
											<?php } else{?>
												<td style="color: red"><?php echo $row['Status'] ?></td>
											<?php } ?>
												<td>
													<a href="mycandidates.php?edit=<?php echo $row['id']; ?>" style = "width: 80px" class = "btn btn-info">Edit</a>
													<a href="mycandidates.php?archive=<?php echo $row['id']; ?>?" class = "btn btn-success" onClick ="return Confirmation();">Archive</a>
													<a href="mycandidates.php?delete=<?php echo $row['id']; ?>" class = "btn btn-danger" onClick ="return Confirmation();">Delete</a>
												</td>
											</tr>
										</tbody>
										<?php endwhile; ?>
										</table>
										<span><?php echo $error; ?></span>


									</div>

							<?php


								function pre_r($array){
									echo '<pre>';
									print_r($array);
									echo '</pre>';
								}


							?>
							
						</form>
								

					</div>
		


</section>
<script>
	
	function getFocus(){
		document.getElementById("focus").focus();
	}
</script>

	<script type="text/javascript">
			function Confirmation(){
				var x = confirm("Are you sure you want to delete this Candidate?");
				if(x==true){
					return true;
				}else{
					return false;
				}

			}
		</script>

				<script type="text/javascript">
			function Confirmation(){
				var x = confirm("Are you sure you want to archive this Candidate?");
				if(x==true){
					return true;
				}else{
					return false;
				}

			}
		</script>
		<script type="text/javascript">
			setTimeout(function(){
    		$('.fadeout').hide();
			},3000);
		</script>

 
 <div class="footer" style="position: fixed; left: 0;bottom: 0; width: 100%; text-align:right;color: #054b88; justify-content: left; font-size: 11px">
    <div class="">
<p>
            Copyright 2020 @
            STI College Tanauan SSC-Voting System

   </p>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</body>
</html>


<?php } else {header('location: index.php');} ?>

<script>
	$(document).ready(function(){
		$('.action').change(function(){
			if($(this).val() != '')
			{
				var action = $(this).attr("id");
				var query = $(this).val();
				var result =  '';
				if(action == "level")
				{
					result = 'yearlevel';
				}
				else
				{
					result = 'program';
				}
				$.ajax({
					url:"../admin/ajaxforcandidlevel.php",
					method:"POST",
					data:{action:action, query:query}, success:function(data){
						$('#'+result).html(data);
					}
				})
			}
		});
	});
</script>
<script>
	$(document).ready(function(){
		$('.action').change(function(){
			if($(this).val() != '')
			{
				var action = $(this).attr("id");
				var query = $(this).val();
				var result =  '';
				if(action == "level")
				{
					result = 'position';
				}
				$.ajax({
					url:"../admin/ajaxforcandidposition.php",
					method:"POST",
					data:{action:action, query:query}, success:function(data){
						$('#'+result).html(data);
					}
				})
			}
		});
	});
</script>
<script>
	$(document).ready(function(){
		$('.action').change(function(){
			if($(this).val() != '')
			{
				var action = $(this).attr("id");
				var query = $(this).val();
				var result =  '';
				if(action == "level")
				{
					result = 'partylist';
				}
				$.ajax({
					url:"ajaxforpartylist.php",
					method:"POST",
					data:{action:action, query:query}, success:function(data){
						$('#'+result).html(data);
					}
				})
			}
		});
	});
</script>