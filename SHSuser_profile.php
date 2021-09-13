<?php
session_start();

$success2 = "";
$success = "";
$error_confirm1 = "";
$error_notequal = "";
include 'admin/includes/connect.php';

if(isset($_POST['upload'])){
    $id = $_SESSION['ID'];
    $target_dir = "image/";
       $target_file = $target_dir . basename($_FILES["image"]["name"]);     
       move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

  $query="UPDATE tbl_addvoters set user_image = '$target_file' where uid='$id'";
        $ex=mysqli_query($mysqli,$query);
        if($ex){

            $_SESSION['message'] = "Image uploaded... ";
          $_SESSION['msg_type'] = "success";
          
        }
        else{
            $_SESSION['message'] = "Uploading failed.. Please try again ";
          $_SESSION['msg_type'] = "danger";
        }
    }

$id = $_SESSION['ID'];
 $result = $mysqli->query("SELECT * from tbl_addvoters where uid='$id'") or die ($mysqli->error());
  if(mysqli_num_rows($result) ==1){
    $row  = $result->fetch_array();
    $pass = $row['password'];
    $image = $row['user_image'];
  }

if(isset($_POST['submit'])){
$current = $_POST['current'];
$confirmpassword = $_POST['confirmpassword'];
$error = false;
$error1 = false;
$success1 = false;
$Newpassword = $_POST['Newpassword'];


 if($current != $pass){
         $_SESSION['message'] = "Current password is incorrect... ";
  $_SESSION['msg_type'] = "warning";
   header('location: user_profile.php');
   exit() ;

  }
 

else{
   
     $confirmpassword = $_POST['confirmpassword'];
        $id= $_SESSION['ID'];
    $mysqli->query("UPDATE tbl_addvoters set password = '$confirmpassword' where uid='$id'") or die($mysqli->error());
  
  $_SESSION['message'] = "Password  successfully changed... ";
  $_SESSION['msg_type'] = "success";
   header('location: user_profile.php');
   exit() ;
  }
}



if (isset($_SESSION['ID'])){


   //echo 'welcome'; echo $_SESSION['email'];
   //echo '<a href = "logout.php">logout</a>';
   //checking of running election
     $query1 = "SELECT * from tbl_schoolyear where Status = 'Running'";
                    $res = mysqli_query($mysqli, $query1);
?>

 <!DOCTYPE html>
<html>
<head>
  <title>SSC Voting</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie-edge">
  <link rel="stylesheet" href="css/user_profile2.css">
  <script src="http://code.jquery.com/jquery-3.4.1.js" ></script>
    <link rel="stylesheet" type="text/css" href="admin/fontawesome/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script type="text/javascript" src="admin/js/jquery.js"></script>
    </head>

    <style type="text/css">


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

      .pass{
        background: white;
        border: 0;
        border: 1px solid #0d2d50;
        width: 200px; 

      }
      #confirmpass{
        display: none;
        height: 300px;
        width: 350px;
        border: none;
        background: transparent;
        border-radius: 5px;
        text-align: center;
        padding: 30px 0 0px 15px;
        margin: 0 0 0 230px;
        position: fixed;
        
      }
    </style>

  
<body style="background: white">




            
                <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
                    
                    <!--    <a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                         aria-controls="navbarSupportedContent" aria-expanded ="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                         </button>

                           <p style="position: auto; padding:10px 0 0 30px; font-size: 20px; color: #025baa;"><strong>STI COLLEGE TANAUAN
                            SSC VOTING SYSTEM</strong></p>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">

                                <li class="nav-item">
                                    <a href="SHSyear.php" class="nav-link "><i class='fa fa-home' style='font-size:15px;color:#015baa;margin: 4px'></i>Home</a>
                                </li>


                                 <li class="nav-item">
                                    <a href="SHSuser_profile.php" class="nav-link hovers"><i class='far fa-user-circle' style='font-size:15px;color:#015baa;margin: 4px'></i><?php echo  $_SESSION['GetUser']; ?></a>
                                </li>


                    <?php
                    if(mysqli_num_rows($res) == ""){?>
                        

                    <?php } else {?>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Results
                                   </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                       <a class="dropdown-item" href="SHS_votingResult.php">Senior High</a>
                                       <a class="dropdown-item" href="TER.VR.php">Tertiary</a>
                                       
                                     </div>                             
                                </li>
                    <?php } ?>

                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt" style='font-size:15px;color:#015baa;margin: 4px'></i>Logout</a>
                                </li>


                                
                            </ul>
                        </div>
                    
                </nav>
<br><br><br>
<div>
 <div class="col-md-6 col-md-offset-3 mx-auto" style=" box-shadow: inset 0 -3em 3em rgba(0,0,0,0.2), 0 0  0 2px rgb(255,255,255),0.3em 0.3em 2em rgba(0,0,0,0.5);border: 1px solid #ccc;height: 600px;width: 600px; border-radius: 5px;background: white;position: relative; margin-left: 300px;" >

  <?php 
              
                  if(isset($_SESSION['message'])):

                ?>

                  <div style="float: right; background: white; width: 300px; margin-top: 4px; " class="alert alert-<?=$_SESSION['msg_type']?> ">

                  <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                  ?>
                  </div>
                <?php endif ?>


              <p style='color:black;margin:5px 0 20px 15px; font-weight: 400; font-size: 25px; '>My Account</p>
              <hr style="background: blue;">

              <?php
              $id = $_SESSION['ID'];
                  $query="select * from tbl_addvoters WHERE uid='$id' ";
                  $ex=mysqli_query($mysqli,$query);
                  $row=mysqli_fetch_array($ex)
              ?>


             <img src= "<?php echo $row['user_image']; ?>"  style=" height: 100px; width: 110px;align-content: center; border-radius: 50%; margin-left:  225px;" /> 
                            
                    <form action="" method="POST" name="vform">

                      <div id="confirmpass">
                      <div id="show_result"></div>
                    <label>Password Confirmation
                     <input type="text" class="form-control form-control-sm pass" name="current" placeholder="Current Password" required></label><br>

                     <label>New Confirmation
                     <input type="password" class="form-control form-control-sm pass" id = "new" name="Newpassword" pattern=".{8,16}" required title="8 to 16 characters" placeholder="New Password"></label><br>
                     <div id="Newpassword_error" style="color: red; font-size: 12px"></div>

                     <label>Confirm Confirmation
                     <input type="password" class="form-control form-control-sm pass" id="confirm" name="confirmpassword" pattern=".{8,16}" required title="8 to 16 characters" placeholder="Confirm Password" onfocusout="password_match()"></label><br>
                     <div id="confirmpassword_error" style="color: red;padding-top: 30px; font-size: 12px"></div>

                     <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                      <button type="submit" class="btn btn-warning"  onclick="document.getElementById('confirmpass').style.display='none' " name="submit">Cancel</button>
                   
              </div>
                </form>
              <p style='color:black;margin:5px 0 0 0px;font-weight: 600; text-align: center; letter-spacing: .5px'><?php echo "ID: " .$_SESSION['studentid']; ?></p>
              <p style='color:black;margin:10px 0 0 25px; '><strong>Firstname:</strong> <?php echo $row['Firstname']; ?></p>
              <p style='color:black;margin:10px 0 0 25px; '><strong>Lastname:</strong> <?php echo $_SESSION['lastname']; ?></p>
              <p style='color:black;margin:10px 0 0 25px; '><strong>Middle Initial:</strong> <?php echo $_SESSION['middle']; ?></p>
              <p style='color:black;margin:10px 0 0 25px; '><strong>Suffix: </strong><?php echo $_SESSION['suffix']; ?></p>
              <p style='color:black;margin:10px 0 0 25px; '><strong>Year/Program:</strong> <?php echo $_SESSION['yearlevel']. "-".$_SESSION['program']; ?></p>
              <p style='color:black;margin:10px 0 0 25px; '><strong>E-mail:</strong> <?php echo $_SESSION['email']; ?></p>
               <form action="" method="POST" enctype="multipart/form-data" >
                <label style='color:black;margin:10px 0 0 25px;'><strong>Change profile picture</strong><br>
                  <input type="file" name="image"></label><br>
                  <input type="submit" name="upload"  class="btn btn-info" value="upload" style="margin:10px 0 0 25px;"></label><br>
           
                </form>
              <a style='margin:15px 0 0 25px; color: #08b2c3; cursor: pointer; '  onclick="document.getElementById('confirmpass').style.display='block' ">Change Password</a><br>
               <span id="error1" style="color: red;margin: 0 0 0 25px;"><?php echo $error_confirm1; ?></span><br>
               <span id="error" style="color: red;margin: 0 0 0 25px;"><?php echo $error_notequal; ?></span>
                <span id="success1" style="color: #08b2c5;margin: 0 0 0 15px;"><?php echo $success; ?></span>
                <span id="success1" style="color: #08b2c5;margin: 0 0 0 26px;"><?php echo $success2; ?></span>  
              <br>


            
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
  <script type="text/javascript" src="admin/js/jquery.js"></script>
 <script type="text/javascript">
  
  // var Newpassword = document.forms["vform"]["Newpassword"];
  // var confirmpassword = document.forms["vform"]["confirmpassword"];


  // var Newpassword_error = document.getElementById("Newpassword_error");


  //  Newpassword.addEventListener("blur", NewpasswordVerify, true);


  // function validation(){
  //       if(Newpassword.value == ""){
  //     Newpassword_error.textContent = "required dont leave it blank";
  //     Newpassword.focus();
  //     return false;
    
  //   }

  // }



  // function NewpasswordVerify(){
  //     if(Newpassword.value != ""){
  //     Newpassword_error.innerHTML = "";

  //     return true;
    
  //   }
  // }

  function password_match(){
      var new1 = document.getElementById('new').value;
      var confirm2 = document.getElementById('confirm').value;
        
        $.post("check.php", {
          new11: new1, confirm22: confirm2
        },

        function(data, status){
          document.getElementById('show_result').innerHTML = data;
           if(document.getElementById('new').value == document.getElementById('confirm').value){
             document.getElementById('new').value;
          document.getElementById('confirm').value;
        }
      else{
          document.getElementById('new').value = "";
          document.getElementById('confirm').value = "";
        }
        }
        )
  }
</script>




