<?php 
//require("auth.php");
session_start();
include 'includes/connect.php';

$update = false;
$schoolyear = "";
$Status = "";
$schoolyear_error = "";

if(isset($_POST['submit'])){
	$schoolyear = $_POST['schoolyear'];
	$Status = $_POST['Status'];
	$error = false;


	if($mysqli->connect_error){
		die('Connection Failed  : ' .$mysqli->connect_error);
		exit();
	}

		$sql = "SELECT * from tbl_schoolyear where schoolyear = '$schoolyear'";
		$result1 = mysqli_query($mysqli,$sql);
		$sql1 = "SELECT * from tbl_schoolyear where Status = 'Active' or schoolyear = '$schoolyear'";
		$result2 = mysqli_query($mysqli,$sql1);
		if(mysqli_num_rows($result1) >0){
			header('location: addschoolyear.php?School Year-already-exist');
			$_SESSION['message'] = "School Year Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
			// $schoolyear_error = "*School year already exist..";
			// $error = true;
		
		}
		else if(mysqli_num_rows($result2) == true && $_POST['Status'] == 'Inactive'){
			$stmt = $mysqli->prepare("insert into tbl_schoolyear(schoolyear,Status)
			values(?,?)");
			$stmt->bind_param("ss",$schoolyear,$Status);
			$stmt->execute();
			//echo "Position Added Successfully...";
			$stmt->close();
			$mysqli->close();

			$_SESSION['message'] = "School Year Added Successfully...	";
			$_SESSION['msg_type'] = "success";
			header('location: addschoolyear.php');
			exit() ;
		}
		else if(mysqli_num_rows($result2) == true){
			$_SESSION['message'] = "Only one schoolyear can be activated at a time!";
			$_SESSION['msg_type'] = "danger";
			header('location: addschoolyear.php');
	 		exit();
		}
		else
	{
		$stmt = $mysqli->prepare("insert into tbl_schoolyear(schoolyear,Status)
			values(?,?)");
		$stmt->bind_param("ss",$schoolyear,$Status);
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
		
if(isset($_GET['stop'])){
		$id = $_GET['stop'];
		date_default_timezone_set('Asia/Manila');      
		$date=date("Y/m/d h:i:sa");
		// $date = date_create()->format('Y-m-d H:i:s');
		$mysqli->query("UPDATE tbl_schoolyear set Status = 'Ended' where id='$id'") or die($mysqli->error());

		$_SESSION['message'] = "SSC Election ended!";
		$_SESSION['msg_type'] = "danger";
		 header('location: addschoolyear.php');
		 exit();


}
if(isset($_GET['start'])){

$id = $_GET['start'];
// $date = date_create()->format('Y-m-d H:i:s');
date_default_timezone_set('Asia/Manila');      
		$date=date("Y/m/d h:i:sa");
		$dateEnded=date("Y/m/d h:i:sa", strtotime("$date + 11 hours"));
$mysqli->query("UPDATE tbl_schoolyear set Status = 'Running', timeStarted = '$date', timeEnded = '$dateEnded' where id='$id'") or die($mysqli->error());

		$_SESSION['message'] = "SSC Election started!";
		$_SESSION['msg_type'] = "success";
		 header('location: addschoolyear.php');
		 exit();

 }


if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_schoolyear where id='$id'") or die ($mysqli->error());
	if(mysqli_num_rows($result) ){
		$row  = $result->fetch_array();
		$id = $row['id'];
		$schoolyear = $row['schoolyear'];
		$Status = $row['Status'];
	

	}
}

if(isset($_GET['archive'])){
	$id = $_GET['archive'];
	$result = $mysqli->query("SELECT * from tbl_schoolyear where Status = 'Running' or Status = 'Active' ") or die ($mysqli->error());
	mysqli_num_rows($result);
	$result1 = $mysqli->query("SELECT * from tbl_schoolyear where Status = 'Running' or Status = 'Active' and id = '$id' ") or die ($mysqli->error());
	mysqli_num_rows($result1);
	$row = $result1->fetch_assoc();
	if (mysqli_num_rows($result) > 0) {
		$_SESSION['message'] = "Only one schoolyear can be activated or running at a time!";
	$_SESSION['msg_type'] = "danger";
	 header('location: addschoolyear.php');
	 exit();
	}
	else if ( mysqli_num_rows($result1) > 0){
	 $mysqli->query("UPDATE tbl_schoolyear set Status='Inactive' where id ='$id'") or die($mysqli->error());

	$_SESSION['message'] = "Record archived!";
	$_SESSION['msg_type'] = "warning";
	 header('location: addschoolyear.php');
	 exit();
	}else{
	$mysqli->query("UPDATE tbl_schoolyear set Status='Inactive' where id ='$id'") or die($mysqli->error());

	$_SESSION['message'] = "Record archived!";
	$_SESSION['msg_type'] = "warning";
	 header('location: addschoolyear.php');
	}

}

if(isset($_POST['update'])){
			$id = $_POST['id'];
		$schoolyear = $_POST['schoolyear'];
		$Status = $_POST['Status'];



		$sql = "SELECT * from tbl_schoolyear where schoolyear = '$schoolyear'";
		$result1 = mysqli_query($mysqli,$sql);
		$sql1 = "SELECT * from tbl_schoolyear where Status = 'Active' or Status = 'Running' ";
		$result2 = mysqli_query($mysqli,$sql1);
		// if(mysqli_num_rows($result1) >0){
		// 	header('location: addschoolyear.php?School Year-already-exist');
		// 	$_SESSION['message'] = "School Year Already Exist!";
		// 	$_SESSION['msg_type'] = "danger";
		// 	exit();
		// 	// $schoolyear_error = "*School year already exist..";
		// 	// $error = true;
		
		// 	}
			
		 if(mysqli_num_rows($result2) == 1 && $_POST['Status'] == 'Inactive'){
			$mysqli->query("UPDATE tbl_schoolyear set Status='$Status' where id ='$id'") or die($mysqli->error());

			$_SESSION['message'] = "Schoolyear updated successfully...	";
			$_SESSION['msg_type'] = "warning";
			header('location: addschoolyear.php');
			exit();
		}
		else if(mysqli_num_rows($result2) == false && $_POST['Status'] == 'Active'){
			$mysqli->query("UPDATE tbl_schoolyear set Status='$Status' where id ='$id'") or die($mysqli->error());


			$_SESSION['message'] = "Schoolyear updated successfully...	";
			$_SESSION['msg_type'] = "warning";
			header('location: addschoolyear.php');
			exit();
		}
		else if(mysqli_num_rows($result2) == 1){
$_SESSION['message'] = "Only one schoolyear can be activated or running at a time!";
			$_SESSION['msg_type'] = "danger";
			header('location: addschoolyear.php');
	 		exit();
		}


		// else if(mysqli_num_rows($result1) > 1){
		// 	header('location: addschoolyear.php?School Year-already-exist');
		// 	$_SESSION['message'] = "School Year Already Exist!";
		// 	$_SESSION['msg_type'] = "danger";
		// 	exit();
		// }
		else
	{
		$mysqli->query("UPDATE tbl_schoolyear set Status='$Status' where id ='$id'") or die($mysqli->error());


			$_SESSION['message'] = "Schoolyear updated successfully...	";
			$_SESSION['msg_type'] = "warning";
			header('location: addschoolyear.php');
			exit();
	}

}


			if (isset($_SESSION['USER_ID'])){
 //election running checker
        $query1 = "SELECT * from tbl_schoolyear where Status = 'Running'";
        $res = mysqli_query($mysqli, $query1);



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
	 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

	<link rel="stylesheet" type="text/css" href="addschoolyear4.css">
	

	<style>

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
	font-size: 14px;
	border-radius: 5px;

}
</style>


	
</head>
<body>
	


				<nav class="navbar navbar-expand-sm navbar-dark ">
					
					<!-- 	<a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->
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

								<li class="nav-item ">
									<a href="addvoters.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Voters</a>
								</li>

								<li class="nav-item">
										<a href="addschoolyear.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Schoolyear</a>
									</li>

								<li class="nav-item">
									<a href="addparty.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Partylist</a>
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
		



<section class="main">

<div class="container">


				<div class="row no-gutters">


					<div class="col-sm-6 no-gutters" id="createform">

						<form class="stu-container" action="addschoolyear.php" method="POST">

<br>

							<input type="hidden" name="id" value="<?php echo $id; ?>">
 							<h1> add schoolyear</h1><br><br>
							  <label for="partyinfo">Shoolyear</label><br>
							 	<?php
									if($update == true):
								?>
										<p>Can't update schoolyear!</p>

								<?php else: ?>
									   <select name = "schoolyear" id = "partyinfo" class ="candidateinfo" placeholder ="Choose School Year" required>
								<?php endif; ?>
												<?php
													if($update == true):
												?><p><?php echo $schoolyear; ?></p>
											 		<!-- <option vlaues = "2019-2020" >2019-2020</option>
						 							<option vlaues = "2020-2021" >2020-2021</option>
						 							<option vlaues = "2021-2022" >2021-2022</option>
						 							<option vlaues = "2022-2023" >2022-2023</option>
						 							<option vlaues = "2023-2024" >2023-2024</option>
						 							<option vlaues = "2024-2025" >2024-2025</option>
						 							<option vlaues = "2025-2026" >2025-2026</option>
													<option vlaues = "2026-2027" >2026-2027</option>
						 							<option vlaues = "2027-2028" >2027-2028</option>
						 							<option vlaues = "2028-2029" >2028-2029</option>
						 							<option vlaues = "2029-2030" >2029-2030</option>
						 							<option vlaues = "2030-2031" >2030-2031</option>
						 							<option vlaues = "2031-2032" >2031-2032</option>
						 							<option vlaues = "2032-2033" >2032-2033</option> -->
											




							
												<?php else: ?>
						 							<option vlaues = "2020-2021" >2020-2021</option>
						 							<option vlaues = "2021-2022" >2021-2022</option>
						 							<option vlaues = "2022-2023" >2022-2023</option>
						 							<option vlaues = "2023-2024" >2023-2024</option>
						 							<option vlaues = "2024-2025" >2024-2025</option>
						 							<option vlaues = "2025-2026" >2025-2026</option>
													<option vlaues = "2026-2027" >2026-2027</option>
						 							<option vlaues = "2027-2028" >2027-2028</option>
						 							<option vlaues = "2028-2029" >2028-2029</option>
						 							<option vlaues = "2029-2030" >2029-2030</option>
						 							<option vlaues = "2030-2031" >2030-2031</option>
						 							<option vlaues = "2031-2032" >2031-2032</option>
						 							<option vlaues = "2032-2033" >2032-2033</option>
						 							<option vlaues = "2033-2034" >2033-2034</option>
						 							<option vlaues = "2034-2035" >2034-2035</option>
						 							

												
												<?php endif; ?>
								</select><br>	
								<span class = "error" style="color:red; font-size: 12px;" ><?php echo $schoolyear_error; ?></span><br>
							  <div>
							<label class="infogender" style="color: black" >Status<br>

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


							

							  <?php
								if($update == true):
							?>

							<button type="submit" class="btn btn-info buttondes " name="update">Update</button>
							<a type="submit" class="btn btn buttondes " style=" border: 1px solid #17a2b8; margin:20px;border-radius:5px ;  width: 100px;" href="addschoolyear.php" >Cancel</a>
							<?php else: ?>
								<button type="submit" class="btn btn-primary buttondes" name="submit">Save</button>
							<?php endif; ?>
							  
							</form>
						
					</div>









				


					<div class="col-sm-6 no-gutters borders" id="createform">

						<?php 
							
									if(isset($_SESSION['message'])):

		 						?>

		 							<div class="alert alert-<?=$_SESSION['msg_type']?> fadeout ">

		 							<?php
		 								echo $_SESSION['message'];
		 								unset($_SESSION['message']);
		 							?>
		 							</div>
								<?php endif ?>

						<form class="stu-container" action="" method="POST">
 							<h1></h1><br><br><br><br>
							 


							<?php

							//for the table
					 $results = $mysqli->query("select * from tbl_schoolyear order by id desc") or die($mysqli->error);



							?>
										<text >Running election ends in <span id = "count">5</span>s</text>
									<div class="container1">
										<table>
											<thead>
												<tr>
													<th>School Year</th>
													<th>Time Started</th>
													<th>Time Ended</th>
													<th>Status</th>
													
													<th colspan="3">Action</th>
												</tr>
											</thead>
											<?php
												while($row = $results->fetch_assoc()):
											?>
										<tbody>
											<tr>
												<td><?php echo $row['schoolyear'] ?></td>
												<td><?php echo $row['timeStarted'] ?></td>
												<td><?php echo $row['timeEnded'] ?></td>
												<?php if($row['Status'] == 'Active'){?>
												<td style="color: #04e2b5"><?php echo $row['Status'] ?></td>
												<!--  -->
											<?php } else{?>
												<td style="color: red"><?php echo $row['Status'] ?></td>
											<?php } ?>
												
												<td style="text-align: left;" >
													
													<a href="addschoolyear.php?edit=<?php echo $row['id']; ?>" style ="width:70px;"  class = "btn btn-info">Edit</a>
													<!-- <a href="addschoolyear.php?archive=<?php echo $row['id']; ?>" class = "btn btn-success" onClick ="return Confirm();">Archive</a> -->
													<?php if($row['Status'] == 'Active'){?>
													<a href="addschoolyear.php?start=<?php echo $row['id']; ?>"  id = "mylink" style ="width:70px;"  class = "btn btn-warning">Start</a>
														<?php } else{}?>
													<?php $currenttime = date("Y-m-d h:m:s");
														 if($row['Status'] == 'Running'  ){?>
													<a href="addschoolyear.php?stop=<?php echo $row['id']; ?>" id="stop" style ="width:70px; background: ;"  class = "btn btn-danger">Stop</a>
														<?php } else{}?>

												</td>
											</tr>
										</tbody>
										<?php endwhile; ?>
										</table>


									</div>


							  
							</form>
						
					</div>
				
				</div>
</div>


</section>





		<script type="text/javascript">
			function Confirm(){
				var x = confirm("Are you sure you want to archive this schoolyear ?");
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
            Copyright 2021 @
            STI College Tanauan SSC-Voting System

   </p>
</div>
</div>


 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> 
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>


<?php } else {header('location: index.php');} ?>

<script>

	function myOtherFunction() {
var counter = 5;
  setInterval(function() {
    counter--;
    if (counter >= 0) {
      span = document.getElementById("count");
      span.innerHTML = counter;
    }
    if (counter === 0) {
    		$(document).ready(function(){
    $("#stop").trigger('click'); 
});
        clearInterval(counter);
    }
  }, 1000);
}

document.getElementById( 'mylink' ).onclick = function() {
   //do stuff...
   myOtherFunction();
};

</script>