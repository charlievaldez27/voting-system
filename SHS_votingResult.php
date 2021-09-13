<?php
session_start();
//include('header.php');
  require("includes/pdo.php");
include "check_token.php";


// 	include_once("includes/conn.php");

// //Include class Voting
// require("classes/Voting.php");

if (isset($_SESSION['ID'])){
	 //echo 'welcome'; echo $_SESSION['email'];
	 //echo '<a href = "logout.php">logout</a>';


?>

 <!DOCTYPE html>
<html>
<head>
	<title>Senior High SSC Voting</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<link rel="stylesheet" href="css/votingResult2.css">
	<script src="http://code.jquery.com/jquery-3.4.1.js" ></script>
    <link rel="stylesheet" type="text/css" href="admin/fontawesome/css/all.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script type="text/javascript" src="admin/js/jquery.js"></script>
    <script type="application/javascript">

        setInterval(function(){
        $('#showresult').load('SHS_user-result.php');
         },1000);

    </script>

     <style>
       @media (max-width: 480px){
  body{
    margin: 0px;
    padding: 0px;
    overflow-x: hidden;
    font-size: 13px;
  }
  .navbar{
    width: 100%;
  }
  .navbar p strong{
    font-size: 12px;
    margin-bottom: 15px;
    padding-left: 15px;

    position: absolute;
  }
  .navbar button{
    position: absolute;
    margin-top: 9px;

  }
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
	
<body>




    
            
                <nav class="navbar navbar-expand-sm navbar-dark ">
                   <p style=" padding:10px 0 0 30px; font-size: 20px; color: #025baa;"><strong>STI COLLEGE TANAUAN
                            SSC VOTING SYSTEM</strong></p>
                    
                    <!--    <a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                         aria-controls="navbarSupportedContent" aria-expanded ="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                         </button>

                          

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">

                                <li class="nav-item">
                                    <a href="SHSyear.php" class="nav-link"><i class='fa fa-home' style='font-size:15px;color:#015baa;margin: 4px'></i>Home</a>
                                </li>


                                <li class="nav-item">
                                    <a href="SHSuser_profile.php" class="nav-link"><i class='far fa-user-circle' style='font-size:15px;color:#015baa;margin: 4px'></i><?php echo  $_SESSION['GetUser']; ?></a>
                                </li>


                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle hovers" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Results
                                   </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                       <a class="dropdown-item" href="SHS_votingResult.php">Senior High</a>
                                       <a class="dropdown-item" href="TER.VR.php">Tertiary</a>
                                       
                                     </div>                             
                                </li>
 

                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt" style='font-size:15px;color:#015baa;margin: 4px'></i>Logout</a>
                                </li>


                                
                            </ul>
                        </div>
                    
                </nav>


<br><br>
<!-- <dir style="height: 300px; width: 100%; background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(img/2.jpg); background-repeat: round;"></dir>
 -->



<?php
			
                $sql = "SELECT schoolyear from tbl_schoolyear where Status = 'Running'";
                

                try{ //for partylist dropdown
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                        }catch(Exception $ex){
                        echo ($ex -> getMessage());
                }

?>

<select name="schoolyear" class="form-control" id="getyear" hidden >
                     
               <?php
                                        foreach($results as $output)
                                    { ?>
                                <option ><?php echo $output["schoolyear"]; ?></option>
                            <?php } ?>
                            
                    </select>



  <div class="col-md-6 col-md-offset-3 mx-auto" id="showresult" >
                <?php include('SHS_user-result.php'); ?>

        </div> 


<br><br><br><br>

<div class="footer" style="position: fixed; left: 0;bottom: 0; width: 100%; text-align:right;color: #054b88; justify-content: left; font-size: 11px">
    <div class="">
<p>
            Copyright 2019 @
            STI College Tanauan SSC-Voting System

   </p>
</div>
</div>



<!-- 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
</body>
</html>


<?php } else {header('location: index.php');} ?>