<?php
session_start();
include 'includes/connect.php';

	$update = false;
	$id ="";
	$Studentid ="";
	$Firstname = "";
	$Lastname ="";
	$MI = "";
	$Suffix = "";
	$Level = "";
	$Status = "";
	$password = "";
	$Program = "";
	$Gender ="";
	$email = "";
	$Password = "";
	$yearlevel = "";
	$error ="";


if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$Level = $_POST['Level'];
	$Studentid = $_POST['Studentid'];
	$Firstname = $_POST['Firstname'];
	$Lastname = $_POST['Lastname'];
	$MI = $_POST['MI'];
	$Suffix = $_POST['Suffix'];
	$Level = $_POST['Level'];
	$Status = $_POST['status'];
	$password = $_POST['password'];
	$Program = $_POST['Program'];
	$Gender = $_POST['Gender'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$yearlevel = $_POST['yearlevel'];
	$encpass = password_hash($password, PASSWORD_BCRYPT);
	$vstat = 'to vote';
	$schoolyear = $_POST['schoolyear'];

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
	 	$stmt = $mysqli->prepare("insert into tbl_addvoters(studentID, Firstname,Lastname,MI,Suffix,Level,Program, Gender, email,password, yearlevel,Status)
	 		values(?,?,?,?,?,?,?,?,?,?,?,?)");
	 	$stmt->bind_param("isssssssssss",$Studentid,$Firstname,$Lastname,$MI,$Suffix,$Level,$Program,$Gender,$email,$encpass,$yearlevel,$Status);
	 	$stmt->execute();
 		//echo "Registration Successfully...";


	 		 	$stmt1 = $mysqli->prepare("INSERT into status(voters_id, Level,schoolyear,vStatus, Status)
	 		values(?,?,?,?,?)");
	 	$stmt1->bind_param("issss",$Studentid,$Level,$schoolyear,$vstat, $Status);
	 	$stmt1->execute();
 		//echo "Registration Successfully...";
	 	$stmt1->close();
	 	$mysqli->close();

	 		$_SESSION['message'] = "Record has been saved!";
	 $_SESSION['msg_type'] = "success";
	  header('location: addvoters.php');
	  exit() ;
	 }
}


if(isset($_GET['delete'])){
	$Studentid = $_GET['delete'];
	$mysqli->query("UPDATE tbl_addvoters set Status = 'Not Enrolled' where studentID='$Studentid'") or die($mysqli->error());

	$_SESSION['message'] = "Record archived!";
	$_SESSION['msg_type'] = "danger";
	 header('location: addvoters.php');
	 exit();


}

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_addvoters where uid='$id'") or die ($mysqli->error());
	if(mysqli_num_rows($result) > 0){
	$row  = $result->fetch_array();
	$id = $row['uid'];
	$Studentid = $row['studentID'];
	$Firstname = $row['Firstname'];
	$Lastname = $row['Lastname'];
	$MI = $row['MI'];
	$Suffix = $row['Suffix'];
	$Status = $row['Status'];
	$Program = $row['Program'];
	$LeveL = $row['Level'];
	$Gender = $row['Gender'];
	$email = $row['email'];
	$Password = $row['password'];
	$yearlevel = $row['yearlevel'];

	}
}

if(isset($_POST['update'])){
$id = $_POST['id'];
$Level = $_POST['Level'];
$Studentid = $_POST['Studentid'];
	$Firstname = $_POST['Firstname'];
	$Lastname = $_POST['Lastname'];
	$MI = $_POST['MI'];
	$Suffix = $_POST['Suffix'];
	$Level = $_POST['Level'];
	$Status = $_POST['status'];
	//$password = $_POST['password'];
	$Program = $_POST['Program'];
	$Gender = $_POST['Gender'];
	$email = $_POST['email'];
	$yearlevel = $_POST['yearlevel'];


$mysqli->query("UPDATE tbl_addvoters set studentID = '$Studentid',Firstname = '$Firstname',Lastname ='$Lastname',MI = '$MI',Suffix = '$Suffix',Level = '$Level',Status = '$Status' ,Program = '$Program',Gender = '$Gender',email = '$email',yearlevel = '$yearlevel' where uid='$id'") or die ($mysqli->error());

$mysqli->query("UPDATE status set Level = '$Level',Status = '$Status' where voters_id='$Studentid'") or die ($mysqli->error());
$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header('location: addvoters.php');
exit();
}


			if (isset($_SESSION['USER_ID'])){
				
				require("../includes/pdo.php");
				$sql = "SELECT yearlevel from tbl_yearlevel";
				$sql1 = "SELECT Gender from tbl_addvoters";
				$sql2 = "SELECT program from tbl_program";
				$sql4 = "SELECT schoolyear from tbl_schoolyear where Status = 'Active' or Status= 'Running' ";



				try{ //for year level dropdown
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$results = $stmt->fetchAll();
					//for gender aauto checked update
					$stmt1 = $conn->prepare($sql1);
					$stmt1->execute();
					$row = $stmt1->fetchAll();
					//for courses
					$stmt2 = $conn->prepare($sql2);
					$stmt2->execute();
					$row1 = $stmt2->fetchAll();


					$stmt4 = $conn->prepare($sql4);
					$stmt4->execute();
					$row4 = $stmt4->fetchAll();

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

    //election running checker
        $query1 = "SELECT * from tbl_schoolyear where Status = 'Running'";
        $res = mysqli_query($db, $query1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<script src="http://code.jquery.com/jquery-3.4.1.js" ></script>
<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
   <script type="text/javascript" src="js/jquery.js"></script>
<script>
									$(document).ready(function(){
										$("#search").click(function(){
											$("#field").focus();
											$("#container").focus();
											$("p").html("focus triggered");
										});
									});
</script>
</head>
 <style>
 	.required label:after { 
 		color: red;
 		content: '*'; 
 		display: inline;
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
</style>
<style type="text/css">
	body{
	padding: 0;
	margin: 0;

}
.hovers{
	background-color: #d39e00;
	color:  #025baa;
	border-radius: 5px;
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
	
	background-size: cover;
	background-position: center;
	padding: 0 0 200px;

	 transition:margin-left 0.5s;
  padding:20px;
  overflow:hidden;
  width:100%;
}
	

 .studentinfo{
	
	background: transparent;
	border: 0;
	border: 1px solid #117a8b;
	width: 450px; 
	

}
.main h1{
	color: #023367;
	text-transform: uppercase;
	padding-left: 150px;
	font-size: 20px;
}
.radio{
	color:#858585;
	position: relative;
	display: block;
}
.infogender{	 
		padding-left: 0px;	
		color:#858585;
}
.gender{
	color:#858585;
	border: 1px solid #117a8b;
	border-radius: 3px;
	width:300px;
	text-align: center;
	align-items: center;
}
.gencon{
	display: block;
	padding: 0px 0 0px 30px;
	margin: 10px;
}
.gencon input[type = "radio"]
{
	border: 2px solid #74b4f9;
}

.buttondes{
	padding: 5px 30px 5px 30px;
}

.center{
text-align: center;
}

.container1{
	height: 50vh;
	width: 1200px;
	max-height: 470px;
	overflow-y: auto;
	border-collapse: collapse;
	position: sticky;

}
table thead th,table tbody td{
	padding: 4px 15px 4px 15px;
	text-align: left;
	align-items: center;
	border-bottom: 1px solid #ccc;
	border: 1px solid #ccc;
	border-radius: 5px;
	font-size: 12px;
}
table thead th{
	background: #0a57a9;
	color: white;
	text-transform: uppercase;
	position: sticky;
	text-align: center;
	top: -1px;
	font-size: 16px;
	border-radius: 5px;

}
.asterisk_input::after {
content:"*"; 
color: #e32;
position: absolute; 
margin: -5px 0px 0px -10px; 
font-size: large; 
padding: 0 5px 0 0; }

</style>


<body>



					<nav class="navbar navbar-expand-sm navbar-dark ">
						
							<!-- <a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
							 aria-controls="navbarSupportedContent" aria-expanded ="false" aria-label="Toggle navigation">
							 	<span class="navbar-toggler-icon"></span>
							 </button>

							  <p style=" padding-top: 17px; font-size: 20px; color: #025baa;"><strong>STI COLLEGE TANAUAN <br>
	                            SSC VOTING SYSTEM</strong></p>

							<div class="collapse navbar-collapse" id="navbarSupportedContent">
								<ul class="navbar-nav ml-auto">


									<li class="nav-item">
									<a href="home.php" class="nav-link"><i class='fas fa-home' style='font-size:13px;color:#015baa;margin: 4px'></i> home	</a>
									</li>

									<li class="nav-item">
									<a href="addvoters.php" class="nav-link hovers"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i> voters	</a>
								</li>

								<li class="nav-item">
										<a href="addschoolyear.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Schoolyear</a>
									</li>

									<li class="nav-item">
									<a href="addparty.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i> Partylist</a>
								</li>


									<li class="nav-item">
										<a href="addposition.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Position</a>
									</li>

									<li class="nav-item">
										<a href="addcandidates.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Candidates</a>
									</li>

					<?php
                    if(mysqli_num_rows($res) == "1"){?>
                        
                                    <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fas fa-poll-h' style='font-size:13px;color:#015baa;margin: 4px'></i>
                                      Current Results
                                   </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                       <a class="dropdown-item" href="viewresults-current.php">Tertiary</a>
                                       <a class="dropdown-item" href="shs.viewresults-current.php">Senior High</a>
                                       
                                     </div>                             
                                  </li>



                    <?php } else {?>
	 
									<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fas fa-poll-h' style='font-size:13px;color:#015baa;margin: 4px'></i>
                                     Past Results
                                   </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                       <a class="dropdown-item" href="viewresults.php">Tertiary</a>
                                       <a class="dropdown-item" href="shs.viewresults.php">Senior High</a>
                                       
                                     </div>                             
                              	  </li>
                    <?php } ?>

									<li class="nav-item">
										<a href="includes/logout.php" class="nav-link"><i class="fas fa-sign-out-alt" style='font-size:13px;color:#015baa;margin: 4px'></i>Logout</a>
									</li>

									
								</ul>
							</div>
						
					</nav>
			
		





				<br><br><br><br><br>
						
		<section class="main">

		
			<div class="container">


				<div class="row no-gutters">


					<div  class="col-sm-6 no-gutters" id="createform">

						<form class="stu-container" action="" method="POST" onsubmit="return validation()" name="vform">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<h1> add voters</h1><br>
							<select name = "schoolyear" class ="form-control form-control-sm schoolyear" value="<?php echo $schoolyear; ?>" placeholder ="Choose school year" hidden>

									<!-- <option disabled selected>Choose School year</option>  -->
									
									<?php
										foreach($row4 as $output)
									{ ?>
						 		<option ><?php echo $output["schoolyear"]; ?></option>
							<?php } ?>
								</select>
							</label
								
							
								<span class="asterisk_input">  </span><label class="info">Student ID <br>
							<input type="number"  pattern="[0-9]+" title="Student id should contain 11 to 13 numbers" maxlength="13" minlength="11"  class = "form-control form-control-sm studentinfo" name="Studentid"   value="<?php echo $Studentid; ?>" placeholder="Student ID" required> </label><br>
							<div class="row">
								<div class="col">
 							<span class="asterisk_input">  </span><label class="info">First name<br>
							<input type="text" pattern="[a-zA-Z]+([-\,][a-zA-Z]+)?" title="Firstname should contain only letters" class = "form-control form-control-sm studentinfo" name="Firstname" style="width: 250px" value="<?php echo $Firstname; ?>" placeholder="Firstname" required></label> <br>
								</div>


								<div class="col">
 							<span class="asterisk_input">  </span><label class="info">MI<br>
							<input type="text" pattern="[a-zA-Z]+" title="Middlename should contain only letters" class = "form-control form-control-sm studentinfo" name="MI" style="width: 100px" value="<?php echo $MI; ?>" placeholder="MI" required></label> <br>
								</div>

								<div class="col">
 							<span class="asterisk_input">  </span><label class="info">Last name<br>
							<input type="text" pattern="[a-zA-Z]+([-\,][a-zA-Z]+)?" title="Lastname should contain only letters" class = "form-control form-control-sm studentinfo" name="Lastname" style="width: 250px" value="<?php echo $Lastname; ?>" placeholder="Lastname" required></label> <br>
								</div>

								<div class="col">
 							<label class="info">Suffix <br>
							<input type="text" class = "form-control form-control-sm studentinfo" name="Suffix" style="width: 100px" value="<?php echo $Suffix; ?>" placeholder="Suffix" ></label> <br>
								</div>
							</div>


								<span class="asterisk_input">  </span><label class="info">E-mail Address<br>
							<input type="email" class = " form-control form-control-sm studentinfo" name="email" value="<?php echo $email; ?>" placeholder="E-mail" required></label><br>
							<?php
								if($update == true):
							?>							
							<span class="asterisk_input">  </span><label class="info">Cant't update password.<br>
							<?php else: ?>
							<span class="asterisk_input">  </span><label class="info">Password<br>
							<input type="password" title="password should contain 8 to 16 characters" maxlength="16" minlength="8" class = " form-control form-control-sm studentinfo" name="password" value="<?php echo $Password; ?>" placeholder="Password" required></label>
							<?php endif; ?>


									
							<div class="gencon">
							<span class="asterisk_input">  </span><label class="infogender" style="color: black" >Gender<br>

								<?php
								if($update == true):
									?>
									<input type="radio" name="Gender" value="Male" <?php if($Gender == 'Male'){ echo 'checked'; }?>  required> Male<br>
								
							<?php else: ?>
								<input type="radio" name="Gender" value="Male"  required> Male<br>
										<?php endif; ?>
								

								<?php
								if($update == true):
									?>
									<input type="radio" name="Gender" value="Female" <?php if($Gender == 'Female'){ echo 'checked'; }?>  required> Female<br>
								
							<?php else: ?>
								<input type="radio" name="Gender" value="Female" required> Female
								<?php endif; ?>
								</div>

					</div>
					<div  class="col-sm-6 no-gutters" style="padding-top: 8px; padding-left: 45px" id="createform">
<?php 
if(isset($_SESSION['message'])):
?>
<div class="alert alert-<?=$_SESSION['msg_type']?> fadeout">
<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']);
?>
		</div>
<?php endif ?>
<br><br>
								<span class="asterisk_input">  </span><label class="infogender"style="color: black">Choose Level<br>
								<select name = "Level" id = "level" class ="form-control form-control-sm studentinfo gender action" placeholder ="Choose Level" required>
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
							
							
							<span class="asterisk_input">  </span><label class="infogender" style="color: black">Choose Year Level 
								<br><select name = "yearlevel" id = "yearlevel" class ="form-control form-control-sm studentinfo gender action" placeholder ="Choose Year Level" required style="height: 32px;">
									<!-- <option disabled selected>Choose Year Level</option>  -->
									<?php
								if($update == true):
							?>
									<option ><?php echo $yearlevel; ?></option>
									<?php echo $output; ?>
				
									<?php else: ?>


							<option>Choose Year level</option>
								<?php endif; ?>
								</select>
							</label> <br>

							<span class="asterisk_input">  </span><label class="infogender" style="color: black">Choose Program/Course<br>
								<select name = "Program" id = "program" class ="form-control form-control-sm studentinfo gender" placeholder ="Choose Program/Course" required>
									<!-- <option disabled selected>Choose Year Level</option>  -->
							<?php
								if($update == true):
							?>
									<option ><?php echo $Program; ?></option>
									<?php echo $output1; ?>
							

							
									<?php else: ?>
									<option >Choose Program</option>
							<?php endif; ?>
								</select>
							</label> 


							<br>

							 <div>
							<span class="asterisk_input">  </span><label class="infogender" style="color: black; padding-left: 0px" >Status<br>

								<?php
								if($update == true):
									?>
									<input type="radio" name="status" value="Enrolled" <?php if($Status == 'Enrolled'){ echo 'checked'; }?>  required> Enrolled<br>
								
							<?php else: ?>
								<input type="radio" name="status" value="Enrolled"  required> Enrolled<br>
										<?php endif; ?>
								

								<?php
								if($update == true):
									?>
									<input type="radio" name="status" value="Not Enrolled" <?php if($Status == 'Not Enrolled'){ echo 'checked'; }?>  required> Not Enrolled<br>
								
							<?php else: ?>
								<input type="radio" name="status" value="Not Enrolled" required> Not Enrolled
								<?php endif; ?>
								</div>


								<br><br>
							<?php
								if($update == true):
							?>
								<button type="submit" class="btn btn-info buttondes " name="update">Update</button>
							<a type="submit" class="btn btn buttondes " style=" border: 1px solid #17a2b8; margin:20px;border-radius:5px ;  width: 120px;" href="addvoters.php">Cancel</a>
							<?php else: ?>
								<button type="submit" class="btn btn-primary buttondes" name="submit">Save</button>
							<?php endif; ?>
						</form>
					</div>


				</div>


			</div>




								<br><br><br>

							<h1 style=""> all voters</h1><br>
							<p></p>
							<div  id="createform" style=" padding-left: 50px;position: sticky;">
						<form action="addvoters.php" method="POST">
							 <div class="input-group " style="width: 400px; line-height: 40px; background: transparent; padding-top: 22px">
 							<input type="text" id="field" class="form-control form-control-sm py-2 border-right-0 " name="searched" value="<?php $searched; ?>" placeholder="search" style="width: 100px; margin-left: 50PX; margin-bottom: 10px;border: none; background-color: #f1f1f1 " ><span class="input-group-append" style="background: transparent; height: 50px;">
 								<div class="input-group-text " style="margin-bottom: 10px; background: white; border: none; background-color: #f1f1f1"><i class="fa fa-search"><button type="submit" id="search" class=" btn btn-outline-secondary"  name="search" style=" border: none; font-family: arial">Search</button></i></div></span>
 							<!-- <button type="submit" class=" btn btn-outline-secondary"  name="search">search <i class="fa fa-search"></i></button> -->
 							</div>
 								</form>


							<?php

							
							if (isset($_POST['search'])) {
								$searched = $_POST['searched'];

							$results =  $mysqli->query("SELECT * from tbl_addvoters WHERE CONCAT(`studentID`, `Firstname`, `Lastname`, `email`, `Program`, `yearlevel`, `Status`) like '%$searched%'  order by uid DESC") or die($mysqli->error);

							$results1 =  $mysqli->query("SELECT * from tbl_addvoters WHERE CONCAT(`studentID`, `Firstname`, `Lastname`, `Program`, `yearlevel`, `Status`) like '%$searched%'  order by uid DESC") or die($mysqli->error);
								
							if(mysqli_num_rows($results1) == 0){
								$error =  "<p style = 'color: red'>No record found...</p>";
									}
									}
									else {

							$results = $mysqli->query("SELECT * from tbl_addvoters order by uid DESC") or die($mysqli->error);

									}

							?>

									<div tabindex="-1" id = "container" class="container1">
										<table>
											<thead>
												<tr>
													<th>Student ID</th>
													<th>First name</th>
													<th>Last name</th>
													<th>Level</th>
													<th>Year Level</th>
													<th>Course</th>
													<th>E-mail</th>
													<th>Status</th>
													<th colspan="2">Action</th>
												</tr>
											</thead>
											<?php
												while($row = $results->fetch_assoc()):
											?>
										<tbody>
											<tr>
												<td><?php echo $row['studentID'] ?></td>
												<td><?php echo $row['Firstname'] ?></td>
												<td><?php echo $row['Lastname'] ?></td>
												<td><?php echo $row['Level'] ?></td>
												<td><?php echo $row['yearlevel'] ?></td>
												<td><?php echo $row['Program'] ?></td>
												<td><?php echo $row['email'] ?></td>
												<?php if($row['Status'] == 'Enrolled'){?>
												<td style="color: #04e2b5"><?php echo $row['Status'] ?></td>
											<?php } else{?>
												<td style="color: red"><?php echo $row['Status'] ?></td>
											<?php } ?>
												<td>
													<a href="addvoters.php?edit=<?php echo $row['uid']; ?>" style ="width:80px;" class = "btn btn-primary">Edit</a>
													<a href="addvoters.php?delete=<?php echo $row['studentID']; ?>" class = "btn btn-success" onClick ="return Confirmation();">Archive</a>
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
							
					
								
					</div>


				


		</section>



		<script type="text/javascript">
			function Confirmation(){
				var x = confirm("Are you sure you want to archive this student information?");
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

<br><br><br><br><br>

<div class="footer" style="position: fixed; left: 0;bottom: 0; width: 100%; text-align:right;color: #054b88; justify-content: left; font-size: 11px">
    <div class="">
<p>
            Copyright 2021 @
            STI College Tanauan SSC-Voting System

   </p>
</div>
</div>
     

<!-- 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
</body>
</html>
<?php } else {header('location: index.php');} ?>

<!-- ajax script -->
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
					url:"ajaxforlevel.php",
					method:"POST",
					data:{action:action, query:query}, success:function(data){
						$('#'+result).html(data);
					}
				})
			}
		});
	});
</script>


<!-- <script type="text/javascript">
	
function Validate_first(){
	var val = document.getElementById('validate_first').value;
	if(!val.match(/^[a-zA-Z]+$/)){
		alert('Only alphabets are allowed in Firstname.');
		return false;
	}
	return true;
}
</script>


<script>

	function Validate_mi(){
		var val = document.getElementById('validate_mi').value;
		if(!val.match(/^[a-zA-Z]+$/)){
			alert('Only alphabets are allowed in Middlename. ');
			return false;
		}
		return true;
}
</script>


<script>
	function Validate_last(){
		var val = document.getElementById('validate_last').value;
		if(!val.match(/^[a-zA-Z]+$/)){
			alert('Only alphabets are allowed in Lastname. ');
			return false;
		}
		return true;
}
</script>
 -->







