<?php

session_start();
include 'includes/connect.php';

$update = false;
$partylistname = "";
$Status = "";
$passcode = "";

if(isset($_POST['submit'])){
	$partylistname = $_POST['partylistname'];
	$Status = $_POST['Status'];
	$passcode = $_POST['passcode'];
	$schoolyear = $_POST['schoolyear'];
	$Level = $_POST['Level'];

	if($mysqli->connect_error){
		die('Connection Failed  : ' .$mysqli->connect_error);
		exit();
	}

	$sql = "SELECT * from tbl_partylist where PartylistName = '$partylistname'";
		$result1 = mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result1) > 0){
			header('location: addparty.php?Partylist name-already-exist');
			$_SESSION['message'] = "Partylist Name Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		
		}
		else
	{
		$stmt = $mysqli->prepare("insert into tbl_partylist(Level,PartylistName,Password,Status,schoolyear)
			values(?,?,?,?,?)");
		$stmt->bind_param("sssss",$Level,$partylistname,$passcode,$Status,$schoolyear);
		$stmt->execute();
		//echo "Partylist Added Successfully...";
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


if(isset($_GET['archive'])){
	$PartylistID = $_GET['archive'];
	$mysqli->query("UPDATE tbl_partylist set Status='Inactive' where PartylistID='$PartylistID'") or die($mysqli->error());

	$_SESSION['message'] = "Record archived!";
	$_SESSION['msg_type'] = "warning";
	 header('location: addparty.php');
	 exit();


}


if (isset($_GET['edit'])) {
	$PartylistID = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * from tbl_partylist where PartylistID='$PartylistID'") or die ($mysqli->error());
	if(mysqli_num_rows($result) ==1){
		$row  = $result->fetch_array();
			$PartylistID = $row['PartylistID'];
	$partylistname = $row['PartylistName'];
	$Status = $row['Status'];
	$passcode = $row['Password'];
	$schoolyear = $row['schoolyear'];
	$level = $row['Level'];
	

	}
}

if(isset($_POST['update'])){
$PartylistID = $_POST['PartylistID'];
	$partylistname = $_POST['partylistname'];
	$Status = $_POST['Status'];
	$passcode = $_POST['passcode'];
	$schoolyear = $_POST['schoolyear'];
	$Level = $_POST['Level'];

$sql1 = ("SELECT * from tbl_partylist where PartylistName = '$partylistname' and PartylistID !='$PartylistID'");
		$result1 = mysqli_query($mysqli,$sql1);
		 if (mysqli_num_rows($result1) !=0) {
			header('location: addparty.php?Partylist name-already-exist');
			$_SESSION['message'] = "Partylist Name Already Exist!";
			$_SESSION['msg_type'] = "danger";
			exit();
		}

	else
	{


$mysqli->query("UPDATE tbl_partylist set Level = '$Level', PartylistName = '$partylistname', Password = '$passcode', Status = '$Status', schoolyear = '$schoolyear' where PartylistID='$PartylistID'") or die ($mysqli->error());

$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";
header('location: addparty.php');
exit();
}
}

?> 









<?php
//require("auth.php");

			if (isset($_SESSION['USER_ID'])){

				require("../includes/pdo.php");
				$sql = "SELECT schoolyear from tbl_schoolyear where Status = 'Active'";
				

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
	
	<link rel="stylesheet" type="text/css" href="addparty5.css">
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
.asterisk_input::after {
content:"*"; 
color: #e32;
position: absolute; 
margin: -5px 0px 0px -10px; 
font-size: large; 
padding: 0 5px 0 0; }
.main{
	position: ;
	background: white;
	background-size: cover;
	background-position: center;
	padding: 130px 0 0;
}
</style>

</head>
	 

</head>

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

									<li class="nav-item ">
										<a href="addvoters.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Voters</a>
									</li>

									<li class="nav-item">
										<a href="addschoolyear.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Schoolyear</a>
									</li>

									<li class="nav-item">
										<a href="addparty.php" class="nav-link hovers"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Partylist</a>
									</li>

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

						<form class="stu-container" action="addparty.php" method="POST">
							<input type="hidden" name="PartylistID" value="<?php echo $PartylistID; ?>">
 							<h1> add partylist</h1><br>
 							 <div class="form-group">
							  	<span class="asterisk_input">  </span><label class="info">Choose school year<br>
								<select name = "schoolyear" class ="form-control form-control-sm " id = "partyinfo" value="<?php echo $schoolyear; ?>" placeholder ="Choose school year" required>

									<!-- <option disabled selected>Choose School year</option>  -->
									
									<?php
										foreach($results as $output)
									{ ?>
						 		<option ><?php echo $output["schoolyear"]; ?></option>
							<?php } ?>
								</select>
							</label><br>
							<span class="asterisk_input">  </span><label class="partyinfo"style="color: black">Choose Level<br>
								<select name = "Level" id = "partyinfo" class ="form-control form-control-sm " placeholder ="Choose Level" required>
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

							    <span class="asterisk_input">  </span><label for="partyinfo">Partylist Name</label>
							    <input type="text" class="form-control form-control-sm" id="partyinfo" name = "partylistname" value="<?php echo $partylistname; ?>" placeholder="Partylist Name" required >
							  </div>
							  <div class="form-group">
							    <span class="asterisk_input">  </span><label for="partyinfo">Partylist passcode</label>
							    <input type="password" title="password should contain 8 to 16 numbers" maxlength="16" minlength="8" class="form-control form-control-sm" id="partyinfo" name = "passcode" 
							    value="<?php echo $passcode; ?>" placeholder="Partylist Passcode" required >
							  </div>

							  <span class="asterisk_input">  </span><label class="infogender" style="color: black; " >Status<br>

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
									<input type="radio" name="Status" value="Inactive" <?php if($Status == 'Inactive'){ echo 'checked'; }?>  required>Inactive								
							<?php else: ?>
								<input type="radio" name="Status" value="Inactive" required>Inactive<br>
								<?php endif; ?>
								

							  <?php
								if($update == true):
							?>

							<br><button type="submit" class="btn btn-info buttondes " name="update">Update</button>
							<a type="submit" class="btn btn buttondes " style=" border: 1px solid #17a2b8; margin:20px;border-radius:5px ;  width:80px;" href="addparty.php" >Cancel</a>
							<?php else: ?>
								<br><button type="submit" class="btn btn-primary buttondes" name="submit">Save</button>
							<?php endif; ?>
							  
							</form>
						
					</div>









				


					<div class="col-sm-6 no-gutters borders" id="createform">


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


						<form class="stu-container" action="" method="POST">
 							<h1></h1><br><br>
							 


							<?php

							
							$results = $mysqli->query("select * from tbl_partylist order by PartylistID DESC") or die($mysqli->error);


							?>

									<div class="container1">
										<table>
											<thead>
												<tr>
													<th>Partylist Name</th>
													<th>Status</th>
													<th colspan="3">Action</th>
												</tr>
											</thead>
											<?php
												while($row = $results->fetch_assoc()):
											?>
										<tbody>
											<tr>
												<td ><?php echo $row['PartylistName'] ?></td>
												<?php if($row['Status'] == 'Active'){?>
												<td style="color: #04e2b5"><?php echo $row['Status'] ?></td>
											<?php } else{?>
												<td style="color: red"><?php echo $row['Status'] ?></td>
											<?php } ?>
												
												<td>
													<a href="addparty.php?edit=<?php echo $row['PartylistID']; ?>" style ="width:80px;"  class = "btn btn-primary">Edit</a>
													<a href="addparty.php?archive=<?php echo $row['PartylistID']; ?>" class = "btn btn-success" onClick ="return Confirmation();">Archive</a>
													<a href="addparty.php?delete=<?php echo $row['PartylistID']; ?>" class = "btn btn-danger" onClick ="return Confirm();">Delete</a>
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
				var x = confirm("Are you sure you want to delete this PartyList?");
				if(x==true){
					return true;
				}else{
					return false;
				}

			}
		</script>
		<script type="text/javascript">
			function Confirmation(){
				var x = confirm("Are you sure you want to archive this PartyList?");
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


<?php } else {header('location: index.php');} ?>

