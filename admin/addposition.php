<?php
session_start();
include 'includes/connect.php';

$update = false;
$error = "";
$Positions = "";
$schoolyear = "";
$Level = "";
$Category = "";
$Representatives = "";
$Status = "";
$position_error = "";

if(isset($_POST['submit'])){
	$Positions = $_POST['Positions'];
	$schoolyear = $_POST['schoolyear'];
	$Level = $_POST['Level'];
	$Category = $_POST['Category'];
	$Representatives = $_POST['Representatives'];
	$Status = $_POST['Status'];
	$error = false;
	

	if($mysqli->connect_error){
		die('Connection Failed  : ' .$mysqli->connect_error);
		exit();
	}

	$sql = "SELECT * from tbl_position where position = '$Positions' and Level = '$Level'";
		$result1 = mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result1) >0){
			// header('location: addposition.php?Position-already-exist');
			// $_SESSION['message'] = "Position Name Already Exist!";
			// $_SESSION['msg_type'] = "danger";
			// exit();
			$position_error = "*Position already exist..";
			$error = true;
		
		}
		else
	{
		$stmt = $mysqli->prepare("insert into tbl_position(position,Level,Category,Representatives,schoolyear,Status)
			values(?,?,?,?,?,?)");
		$stmt->bind_param("ssssss",$Positions,$Level,$Category,$Representatives,$schoolyear,$Status);
		$stmt->execute();
		//echo "Position Added Successfully...";
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
	$mysqli->query("UPDATE tbl_position set Status = 'Inactive' where PositionID='$PositionID'") or die($mysqli->error());

	$_SESSION['message'] = "Record archived!";
	$_SESSION['msg_type'] = "danger";
	 header('location: addposition.php');
	 exit();
}
if (isset($_GET['edit'])) {
	$PositionID = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_position where PositionID='$PositionID'") or die ($mysqli->error());
	if(mysqli_num_rows($result) ==1){
		$row  = $result->fetch_array();
			$PositionID = $row['PositionID'];
			$schoolyear = $row['schoolyear'];
	$Positions = $row['position'];
	$level = $row['Level'];
	$Category = $row['Category'];
	$Representatives = $row['Representatives'];
	$Status = $row['Status'];
	

	}
}

if(isset($_POST['update'])){
$PositionID = $_POST['PositionID'];
	$Positions = $_POST['Positions'];
	$Level = $_POST['Level'];
	$Category = $_POST['Category'];
	$Representatives = $_POST['Representatives'];
	$schoolyear = $_POST['schoolyear'];
	$Status = $_POST['Status'];


$mysqli->query("UPDATE tbl_position set position = '$Positions', Level = '$Level', Category = '$Category', Representatives = '$Representatives',schoolyear = '$schoolyear', Status = '$Status' where POsitionID='$PositionID'") or die ($mysqli->error());

$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header('location: addposition.php');
exit();
}



			if (isset($_SESSION['USER_ID'])){

			
				
				require("../includes/pdo.php");
				$sql = "SELECT schoolyear from tbl_schoolyear where Status = 'Active' ";
				

				try{ //for partylist dropdown
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$results = $stmt->fetchAll();
					

				}catch(Exception $ex){
						echo ($ex -> getMessage());
				}
			?>


			 <?php
    //ajax for position

    $Level ='';
    $query = "SELECT Level from tbl_ajaxposition group by Level order by Level ASC";
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
	
	<link rel="stylesheet" type="text/css" href="addposition4.css">

	 <style>
.studentinfo{
	
	background: transparent;
	border: 0;
	border: 1px solid #117a8b;
	width: 450px; 
}
.container1{
	height: 50vh;
	width: 1050px;
	max-height: 470px;
	overflow-y: auto;
	border-collapse: collapse;
	margin-bottom: 200px;
}
table thead th,table tbody td{
	padding: 4px 15px 4px 15px;
	text-align: left;
	align-items: center;
	border-bottom: 1px solid #ccc;
	border: 1px solid #ccc;
	border-radius: 5px;
	font-size: 14px;
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
					
						<!-- <a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->
		
						   <p style=" padding-top: 17px; font-size: 20px; color: #025baa;"><strong>STI COLLEGE TANAUAN <br>
                            SSC VOTING SYSTEM</strong></p>


						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						 aria-controls="navbarSupportedContent" aria-expanded ="false" aria-label="Toggle navigation">
						 	<span class="navbar-toggler-icon"></span>
						 </button>

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
										<a href="addposition.php" class="nav-link hovers"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Position</a>
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

						<form class="stu-container" action="" method="POST">
							<input type="hidden" name="PositionID" value="<?php echo $PositionID; ?>">
 							<h1> add Position</h1><br><br>
							  <div class="form-group">

							  		<span class="asterisk_input">  </span><label class="info">Choose school year<br>
								<select name = "schoolyear" class ="form-control form-control-sm schoolyear" value="<?php echo $schoolyear; ?>" placeholder ="Choose school year" required>

									<!-- <option disabled selected>Choose School year</option>  -->
									
									<?php
										foreach($results as $output)
									{ ?>
						 		<option ><?php echo $output["schoolyear"]; ?></option>
							<?php } ?>
								</select>
							</label><br>


							<span class="asterisk_input">  </span><label class="partyinfo"style="color: black">Choose Level<br>
								<select name = "Level" id = "level" class ="form-control form-control-sm studentinfo gender action" placeholder ="Choose Level" required>
									<!-- <option disabled selected>Choose Year Level</option>  -->
							<?php
								if($update == true):
							?>
									<option ><?php echo $level; ?></option>
								
									<?php echo $Level; ?>


							
									<?php else: ?>
										<option >Choose Level</option>
							
							<?php echo $Level; ?>
							<?php endif; ?>
								</select>
							</label> <br>

							    <span class="asterisk_input">  </span><label for="partyinfo">Position Name</label>
							    <input type="text" class="form-control form-control-sm" id="partyinfo" name = "Positions" value="<?php echo $Positions; ?>" placeholder="Position Name" required >
							    <span class = "error" style="color:red; font-size: 12px;" ><?php echo $position_error; ?></span>
							  </div>

					</div>

					<div class="col-sm-6 no-gutters" id="createform"> 

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
						<br><br><br>

							  <span class="asterisk_input">  </span><label class="partyinfo"style="color: black">Category<br>
								<select name = "Category" id = "Category" class ="form-control form-control-sm studentinfo gender action" placeholder ="Choose category" required>
									<!-- <option disabled selected>Choose Year Level</option>  -->
							<?php
								if($update == true):
							?>
									<option value="<?php echo $Category; ?>" ><?php echo $Category; ?></option>
								
									<?php echo $output; ?>


							
									<?php else: ?>
										<option >Choose Category</option>
							
							
							<?php endif; ?>
								</select>
							</label> <br>

							<div class="rep">
							<span class="asterisk_input">  </span><label class="partyinfo"style="color: black">Representatives<br>
								<select name = "Representatives" id = "Representatives" class ="form-control form-control-sm studentinfo gender " placeholder ="Choose Representatives" >
									<!-- <option disabled selected>Choose Year Level</option>  -->
							<?php
								if($update == true):
							?>
									<option ><?php echo $Representatives; ?></option>
								
									<?php echo $output1; ?>


							
									<?php else: ?>
										<option ></option>
							
						
							<?php endif; ?>
								</select>
							</label> <br></div>



							   <div>
							<span class="asterisk_input">  </span><label class="infogender" style="color: black" >Status<br>

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
							<a type="submit" class="btn btn buttondes " style=" border: 1px solid #17a2b8; margin:20px;border-radius:5px ;  width: 80px;" href="addposition.php">Cancel</a>
							<?php else: ?>
								<button type="submit" class="btn btn-primary buttondes" name="submit">Save</button>
							<?php endif; ?>
							  
							</form>

					</div>

						
					</div>








				


				<!-- <div class="col-sm-6 no-gutters borders" id="createform"> -->
						
							<div  id="createform" style=" padding-left: 50px;position: sticky;">

								<br><br><br>

							<h1 style=""> all positions</h1><br>
						

						<form class="stu-container" action="" method="POST">
 							<h1> </h1>
							 <div class="input-group" style="width: 400px; line-height: 40px; background: transparent; padding-top: 22px">
 							<input type="text" class="form-control form-control-sm py-2 border-right-0 " name="searched" value="<?php $searched; ?>" placeholder="search" style="width: 100px; margin-left: 50PX; margin-bottom: 10px;border: none;background-color: #f1f1f1; " ><span class="input-group-append" style="background: transparent; height: 50px;">
 								<div class="input-group-text " style="margin-bottom: 10px; background: white; border: none; background-color: #f1f1f1"><i class="fa fa-search"><button type="submit" class=" btn btn-outline-secondary"  name="search" style=" border: none; font-family: arial">Search</button></i></div></span>
 							<!-- <button type="submit" class=" btn btn-outline-secondary"  name="search">search <i class="fa fa-search"></i></button> -->
 							</div>

							<?php

							
							if (isset($_POST['search'])) {
								$searched = $_POST['searched'];

							$results =  $mysqli->query("SELECT * from tbl_position where position like '%$searched%' or schoolyear like '%$searched%' order by PositionID DESC") or die($mysqli->error);

							$results1 =  $mysqli->query("SELECT * from tbl_position where position like '%$searched%' or schoolyear like '%$searched%' order by PositionID DESC") or die($mysqli->error);
								
							if(mysqli_num_rows($results1) == 0){
								$error =  "<p style = 'color: red'>No record found...</p>";
									}

									}
									else {

							$results =  $mysqli->query("SELECT * from tbl_position order by PositionID asc") or die($mysqli->error);

									}

							?>

									<div class="container1">
										<table>
											<thead>
												<tr>
													<th>Schoool Year</th>
													<th>Position Name</th>
													<th>Level</th>
													<th>Category</th>
													<th>Representatives</th>
													<th>Status</th>
													
													<th colspan="2">Action</th>
												</tr>
											</thead>
											<?php
												while($row = $results->fetch_assoc()):
											?>
										<tbody>
											<tr>
												<td><?php echo $row['schoolyear']?></td>
												<td><?php echo $row['position'] ?></td>
												<td><?php echo $row['Level']?></td>
												<td><?php echo $row['Category']?></td>
												<td><?php echo $row['Representatives']?></td>
												<?php if($row['Status'] == 'Active'){?>
												<td style="color: #04e2b5"><?php echo $row['Status'] ?></td>
											<?php } else{?>
												<td style="color: red"><?php echo $row['Status'] ?></td>
											<?php } ?>
												
												<td>
													<a href="addposition.php?edit=<?php echo $row['PositionID']; ?>" class = "btn btn-info">Edit</a>
													<a href="addposition.php?delete=<?php echo $row['PositionID']; ?>" class = "btn btn-success" onClick ="return Confirm();">Archive</a>
												</td>
											</tr>
										</tbody>
										<?php endwhile; ?>
										</table>
											<span><?php echo $error; ?></span>



									</div>


							  
							</form>
						
					</div>
				
				</div>
</div>


</section>





		<script type="text/javascript">
			function Confirm(){
				var x = confirm("Are you sure you want to archive this Position?");
				if(x==true){
					return true;
				}else{
					return false;
				}

			}
		</script>

		
 <div class="footer" style="position: fixed; left: 0;bottom: 0; width: 100%; text-align:right;color: #054b88; justify-content: left; font-size: 11px">
    <div class="">
<p>
            Copyright 2021 @
            STI College Tanauan SSC-Voting System

   </p>
</div>
</div>


<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#Category").on('change', function(){
				if($("#Category").val() == "SHS-Normal"){
					$(".rep").hide();
				}
				else if($("#Category").val() == "Tertiary-Normal"){
					$(".rep").hide();
				}
				else{
					$(".rep").show();
				}
			});
		});
	</script>
	<script type="text/javascript">
setTimeout(function(){
    $('.fadeout').hide();
    
},3000);
	</script>
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
					result = 'Category';
				}
				else
				{
					result = 'Representatives';
				}
				$.ajax({
					url:"ajaxforposition.php",
					method:"POST",
					data:{action:action, query:query}, success:function(data){
						$('#'+result).html(data);
					}
				})
			}
		});
	});
</script>