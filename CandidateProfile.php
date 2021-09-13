<?php
session_start();

if (isset($_SESSION['ID'])){
	 //echo 'welcome'; echo $_SESSION['email'];
	 //echo '<a href = "logout.php">logout</a>';
 if ((time() - $_SESSION['last_login_timestamp']) > 3600) {
        header("location: logout.php");
        exit();
    }


?>

 <!DOCTYPE html>
<html>
<head>
	<title>SSC Voting</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<link rel="stylesheet" href="css/Cprofile..css">
	<script src="http://code.jquery.com/jquery-3.4.1.js" ></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script type="text/javascript" src="admin/js/jquery.js"></script>
          <link rel="stylesheet" type="text/css" href="admin/fontawesome/css/all.css">

	
<body>


                <nav class="navbar navbar-expand-sm navbar-dark ">
                    
                    <!--    <a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                         aria-controls="navbarSupportedContent" aria-expanded ="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                         </button>

                           <p style="position: auto; padding: 10px 0 0 30px; font-size: 20px; color: #025baa;"><strong>STI COLLEGE TANAUAN
                            SSC VOTING SYSTEM</strong></p>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">


                                <li class="nav-item">
                                    <a href="year.php" class="nav-link "><i class='fa fa-home' style='font-size:15px;color:#015baa;margin: 4px'></i>Home</a>
                                </li>


                                <li class="nav-item">
                                    <a href="user_profile.php" class="nav-link"><i class='far fa-user-circle' style='font-size:15px;color:#015baa;margin: 4px'></i><?php echo  $_SESSION['GetUser']; ?></a>
                                </li>


                                <li class="nav-item">
                                    <a href="votingResult.php" class="nav-link"><i class='fas fa-poll-h' style='font-size:15px;color:#015baa;margin: 4px'></i>Result</a>

                                </li>
 

                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt" style='font-size:15px;color:#015baa;margin: 4px'></i>Logout</a>
                                </li>


                                
                            </ul>
                        </div>
                    
                </nav>

<br><br><br><br>

<?php
                require("includes/pdo.php");
                $sql = "select schoolyear from tbl_schoolyear where Status = 'Active'";
                

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
                <?php include('Cprofile.php'); ?>

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





</body>
</html>
<?php } else {header('location: index.php');} ?>




