<?php 
session_start();
if (isset($_SESSION['USER_ID'])){
	//election running checker
	require("../includes/pdo.php");
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
		   
			<script type="text/javascript" src="js/jquery.js"></script>
			<link rel="stylesheet" type="text/css" href="home2.css">

    <script type="application/javascript">

        setInterval(function(){
        $('#showtime').load('time.php');
         },1000);

    </script>

 

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
									<a href="home.php" class="nav-link hovers"><i class='fas fa-home' style='font-size:13px;color:#015baa;margin: 4px'></i> home	</a>
									</li>


									<li class="nav-item">
									<a href="addvoters.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i> voters	</a>
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
					<br><br><br><br>
			
<div id="showtime" style="float: right;  font-weight: 600px;  padding-right: 20px;"></div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 

	</body>
</html>
<?php } else {header('location: index.php');} ?>