<?php
session_start(); require_once('includes/conn.php');
 if(isset($_SESSION['ID']) && $_SESSION['Level'] == 'Tertiary'){
   header('location:year.php');
 }
  if(isset($_SESSION['ID']) && $_SESSION['Level'] == 'Senior High'){
   header('location:SHSyear.php');
 }
if (isset ($_POST['login_user'])) {
    // $username = $_POST['username'];
    // $password = $_POST['password'];
       $Senior = 'Senior High';
       $Tertiary = 'Tertiary';
   
    
    //      $query1 = ("SELECT * from tbl_addvoters where email = '$username' and Status = 'Not Enrolled' ");
    // $result1 = mysqli_query($conn, $query1);

        $email = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $check_email = "SELECT * FROM tbl_addvoters WHERE email = '$email' and Status = 'Enrolled' ";
        $res = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($res) == 1){
          $row = mysqli_fetch_assoc($res);
          //$row = $res->fetch_array();
        $fetch_pass = $row['password'];

            if(password_verify($password, $fetch_pass)){
             
                $_SESSION['email'] = $email;
                $status = $row['Level'];
                if($status == 'Tertiary'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
        $_SESSION['ID'] = $row['uid'];
        $_SESSION['studentid'] = $row['studentID'];
        $_SESSION['GetUser'] = $row['Firstname'];
        $_SESSION['lastname'] = $row['Lastname'];
        $_SESSION['middle'] = $row['MI'];
        $_SESSION['suffix'] = $row['Suffix'];
        $_SESSION['Level'] = $row['Level'];
        $_SESSION['program'] = $row['Program'];
        $_SESSION['yearlevel'] = $row['yearlevel'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['Status'] = $row['Status'];
        $_SESSION['pass'] = $row['password'];
        $_SESSION['image'] = $row['user_image'];
        $_SESSION['Availability'] = $row['Availability'];


            $token = getToken(10);
            $_SESSION['email'] = $myusername;
            $_SESSION['token'] = $token;
            $result_token = mysqli_query($mysqli, "select count(*) as allcount from user_token where username='".$myusername."' ");
            $row_token = mysqli_fetch_assoc($result_token);
            if($row_token['allcount'] > 0){
                mysqli_query($mysqli,"update user_token set token='".$token."' where username='".$myusername."'");
            }else{
                mysqli_query($mysqli,"insert into user_token(username,token) values('".$myusername."','".$token."')");
            }
                    header('location: year.php');
                    exit();
      }else if($status = 'Senior High'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
        $_SESSION['ID'] = $row['uid'];
        $_SESSION['studentid'] = $row['studentID'];
        $_SESSION['GetUser'] = $row['Firstname'];
        $_SESSION['lastname'] = $row['Lastname'];
        $_SESSION['middle'] = $row['MI'];
        $_SESSION['suffix'] = $row['Suffix'];
        $_SESSION['Level'] = $row['Level'];
        $_SESSION['program'] = $row['Program'];
        $_SESSION['yearlevel'] = $row['yearlevel'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['Status'] = $row['Status'];
        $_SESSION['pass'] = $row['password'];
        $_SESSION['image'] = $row['user_image'];
        $_SESSION['Availability'] = $row['Availability'];


            $token = getToken(10);
            $_SESSION['email'] = $myusername;
            $_SESSION['token'] = $token;
            $result_token = mysqli_query($mysqli, "select count(*) as allcount from user_token where username='".$myusername."' ");
            $row_token = mysqli_fetch_assoc($result_token);
            if($row_token['allcount'] > 0){
                mysqli_query($mysqli,"update user_token set token='".$token."' where username='".$myusername."'");
            }else{
                mysqli_query($mysqli,"insert into user_token(username,token) values('".$myusername."','".$token."')");
            }
                    header('location: SHSyear.php');
                    exit();
      }

      else{
                 header('location: index.php?login error = Invalid Username Or Password');
                 $_SESSION['message'] = "Invalid username or password!";
                 $_SESSION['msg_type'] = "danger";
                 exit();
                }
            }else{
                 header('location: index.php?login error = Invalid Username Or Password');
                 $_SESSION['message'] = "Invalid username or password!";
                 $_SESSION['msg_type'] = "danger";
                 exit();
            }
        }else{
                header('location: index.php?login error = Invalid Log in');
                $_SESSION['message'] = "Sorry, you are not enrolled!";
                $_SESSION['msg_type'] = "danger";
                exit();
        }


     // if(mysqli_num_rows($result1) ==1 ){
     //    header('location: index.php?login error = Invalid Log in');
     //        $_SESSION['message'] = "Sorry, you are not enrolled!";
     //        $_SESSION['msg_type'] = "danger";
     //        exit();
     //      }

}



// Generate token
function getToken($length){
     $token = "";
     $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
     $codeAlphabet.= "0123456789";
     $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[rand(0, $max-1)];
    }

    return $token;
}


//for graph
  $query ="SELECT Level, count(*) as number from tbl_addvoters where Status = 'Enrolled' group by Level";
$result = mysqli_query($mysqli1,$query);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="admin/fontawesome/css/all.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' 
    integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!--    <link rel="stylesheet" href=https://www.gstatic.com/charts/loader.js> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
     <link href="css/style.min.css" rel="stylesheet">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Level', 'Numbers'],
        <?php 
            while($row = mysqli_fetch_array($result)){
              echo"['".$row['Level']."',".$row['number']."],";
              }
             ?>
        ]);

        var options = {
          title: 'STI College Tanauan total active voters:',
          is3D:true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <title>Sti-ssc Voting</title>

    

</head>


<style type="text/css">


    
    @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900');
body{
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  background: #ffffff;
  color:#666;
  margin: 0px;
    padding: 0px;
    overflow-x: hidden;
}
/*.header{
height: 0vh;
}
.navbar-style{
 line-height: 50px;
  box-shadow: 0 5px 10px #efefef;
  background: #ecb920;
}
.logo img{
  height: 58px;
  width: 90px; 
    

}*/
.card{
    height: 400px;
 width: 380px;
  margin-top: 60px;
 }
 .f, .fc  {
      padding: 10px;
      height: auto;
      font-size: 18px;
      width: auto;
      text-align: center;
      text-decoration: none;
      border-radius: 50%;
      margin-right: 10px;
      box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
     border: 1px solid rgb(0, 217, 255);
    }
    
    
    .fa:hover {
        opacity: 0.7;
    }
    
     .f{
      background: #55ACEE;
      color: white;
    }

     .fc{
      background: #007bb5;
      color: white;
      width: 40px;
    }

     .fc{
      background: #007bb5;
      color: white;
        width: 40px;
    }

.navbar{

  position: fixed;
    padding:0px;
  margin: 0;
  z-index: 8;
  width: auto;
  height: 50px;
  background: #ffc107;
  color: #025baa;
  border-bottom: 1px solid #135190;

}
.main{
  overflow: hidden;
  width: 100%;
  position: relative;
}
 @media (max-width: 480px){
  body{
    margin: 0px;
    padding: 0px;
    overflow-x: hidden;
    font-size: 13px;
  }
  .navbar{
    width: auto;
  }
  .navbar p strong{
    font-size: 12px;
    position: relative;
  }
  div.login-container{
 background-size: center;
  height: 650px;
  width: 100%;
  position: relative;
}
div.card{
position: absolute;
  margin-right: 10px;
  width: 350px;
  }
  ::-webkit-input-placeholder{
    font-size: 13px;

  }
  div.hymn p{
    font-size: 13px;
  }
  div.hymn{
  padding: 120px 20px 0 100px;
  display: none;
}
div.mision, div.vision{
  width: 390px!important;
  position: relative;
  overflow: hidden;
  background-size: 400px;
}
div.test{
  margin: 10px;
  padding: 0px;
}
div#piechart{
  left: 0;
  padding-top: 20px;
  background: ;
  padding-right: 60px;
  padding-left: -100px;
  margin: 0px;
}
footer div#forf{
  height: 480px!important;
  margin-top: 20px!important;
  padding: 0!important;
  margin-bottom: 20px!important;
}
footer div.disp{
display: flex;
    flex-direction: column-reverse;
    }
}


.navbar-dark{
  width: 100%;
  height: 60px;
}

.navbar-dark .navbar-brand{
  color: #025baa
}

.nav-item{
  font-weight: 600;
  font-size: 13px;
  text-transform: uppercase;
  padding: 5px; padding-right: 30px;

}.hovers:hover{
    background-color: #d39e00;
    color:  #025baa;
    border-radius: 5px;
}
.text{
  height: 20px;
  color: #015baa;
  font-size: 20px;
}
.login-container{
  background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(img/2.jpg); 
  background-repeat: no-repeat; 
  background-size: cover;
  height: 550px;
  width: auto;
}
.login-container h1{
  font-weight: bolder;
  font-size: 40px;
  font-family: 'Poppins', sans-serif;
  font-style: BOLD;
}
.login{ 
    padding-left: 300px;
  padding-top: 100px ;
}
.hymn{
  padding: 120px 50px 0 170px;
}
.hymn p{
  font-family: Century Gothic;
  font-size: 20px;
  font-style:  italic;
  color:#ffffff ;
   
}
.login-form{
  margin: auto;
  width: 370px;
  padding: 15px;
  max-width: 100%;
}
.login-form .form-control{
  font-size: 15px;
  min-height: 48px;
  font-weight: 500;
}
.login-form a{
  text-decoration: none;
  color:#666;
}
h1{
  color: #ffffff;
}
.login-form a:hover{
  color:#723dbe;
}
.forgot-link{
  font-size: 13px;
}

.form-control:focus{
  border-color:#723dbe;
  box-shadow: 0 0 0 0.2rem rgba(114,61,190,.25);
}
.btn-custom{
  background: #086edc;
  border-color:#086edc;
  color:#fff;
  font-size: 15px;
  font-weight: 600;
  min-height: 48px;
}
.btn-custom:focus,
.btn-custom:hover,
.btn-custom:active,
.btn-custom:active:focus{
  background: #0856a9;
  border-color: #0856a9;
  color:#fff;
}
.btn-custom:focus{
  box-shadow: 0 0 0 0.2rem rgba(114,61,190,.25);
} 
.hover:hover{
color: white;
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
table th{
    color: black;
}
.modal-md{
    max-width: 50%!important;
    color: black;
}

</style>

<body>

   <!--  <header class="header">
        <nav class="navbar navbar-style">
            <div class="container">
                <div class="navbar-header"> -->

                   <!--  <a href="" class="logo"><img src="logo.png"></a> -->
                   <!--  <div class="navbar-text text">
                        
                            <p style="ppx;"><strong>STI COLLEGE TANAUAN SSC VOTING SYSTEM</strong></p>
                       
                    </div>
                </div>
            </div>
        </nav>
    </header>    
 -->




  <nav class="navbar navbar-expand-sm navbar-dark ">
                    
                    <!--    <a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->
                     

                           <p style="position: auto; padding:10px 0 0 30px; font-size: 19px; color: #025baa; font-weight: normal; font-family: ; "><strong>STI COLLEGE TANAUAN
                            SSC VOTING SYSTEM</strong></p>

                      
                        <!--  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">

                                <li class="nav-item">
                                    <a href="#" class="nav-link hovers" data-toggle="modal" data-target="#mymodalSH" style="color: #015baa;"><i class='fas fa-align-center' style='font-size:15px;color:#015baa;margin: 4px'></i>senior High</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link hovers" data-toggle="modal" data-target="#mymodalTertiary" style="color: #015baa;"><i class='fas fa-align-center' style='font-size:15px;color:#015baa;margin: 4px'></i>Tertiary</a>
                                </li>


                                
                            </ul>
                        </div> -->
                    
                </nav>
                <?php
                    $sql = " SELECT tbl_position.Level, tbl_position.position, tbl_nominees.partylist, CONCAT(tbl_nominees.Firstname,' ', tbl_nominees.MI,'. ', tbl_nominees.Lastname) as Fullname, count(votes.candidate_id) as votes FROM `tbl_position` INNER JOIN tbl_nominees on tbl_nominees.position = tbl_position.position INNER JOIN votes on tbl_nominees.id = votes.candidate_id where tbl_nominees.Level = 'Senior High' and tbl_position.Level = 'Senior High' group BY votes.candidate_id, votes.position order by votes.candidate_id, count(votes.candidate_id) desc ";
                    $results = mysqli_query($mysqli, $sql);
                    ?>
                    <div class="modal fade" id="mymodalSH">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content mod">
                                <div class="modal-header">
                                    <p>Current Senior High SSC Officers:</p>
                                </div>
                                <div class="modal-body">
                                   <div class="table-responsive" id="modal">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Level</th>
                                                    <th>Position</th>
                                                    <th>Party List</th>
                                                    <th>Fullname</th>
                                                    <th>Votes</th>

                                                </tr>
                                            </thead>
                                            <?php
                                            if(mysqli_num_rows($results) > 0){
                                                while($row = mysqli_fetch_array($results)){
                                            
                                            ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['Level'] ?></td>
                                                <td><?php echo $row['position'] ?></td>
                                                <td><?php echo $row['partylist'] ?></td>
                                                <td><?php echo $row['Fullname'] ?></td>
                                                <td><?php echo $row['votes'] ?></td>
                                                
                                            </tr>
                                        </tbody>
                                        <?php }} ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  
                                    <input class="btn btn-warning" data-dismiss="modal" value="Close" style="width: 120px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $sql = " SELECT tbl_position.Level, tbl_position.position, tbl_nominees.partylist, CONCAT(tbl_nominees.Firstname,' ', tbl_nominees.MI,'. ', tbl_nominees.Lastname) as Fullname, count(votes.candidate_id) as votes FROM `tbl_position` INNER JOIN tbl_nominees on tbl_nominees.position = tbl_position.position INNER JOIN votes on tbl_nominees.id = votes.candidate_id where tbl_nominees.Level = 'Tertiary' and tbl_position.Level = 'Tertiary' group BY votes.candidate_id, votes.position order by votes.candidate_id, count(votes.candidate_id) desc ";
                    $results = mysqli_query($mysqli, $sql);
                    ?>
                    <div class="modal fade" id="mymodalTertiary">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content mod">
                                <div class="modal-header">
                                    <p>Current Tertiary SSC Officers:</p>
                                </div>
                                <div class="modal-body">
                                   <div class="table-responsive" id="modal">
                                    <table>
                                            <thead>
                                                <tr>
                                                    <th>Level</th>
                                                    <th>Position</th>
                                                    <th>Party List</th>
                                                    <th>Fullname</th>
                                                    <th>Votes</th>

                                                </tr>
                                            </thead>
                                            <?php
                                            if(mysqli_num_rows($results) > 0){
                                                while($row = mysqli_fetch_array($results)){
                                            
                                            ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['Level'] ?></td>
                                                <td><?php echo $row['position'] ?></td>
                                                <td><?php echo $row['partylist'] ?></td>
                                                <td><?php echo $row['Fullname'] ?></td>
                                                <td><?php echo $row['votes'] ?></td>
                                                
                                            </tr>
                                        </tbody>
                                        <?php }} ?>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  
                                    <input class="btn btn-warning" data-dismiss="modal" value="Close" style="width: 120px;">
                                </div>
                            </div>
                        </div>
                    </div>


<section class="main">
    <div class="container-fluid d-flex login-container">



<div class="hymn">
     <strong style="font-size: 30px; font-family: cursive; color: #fff"></strong> 
<p>Aim high with <bold>STI</bold>
The future is here today<br>
Fly high with <strong>STI</strong><br>
Be the best that you can be
Onward to tomorrow<br>
With dignity and pride<br>
A vision of excellence<br>
Our resounding battle cry<br>
Aim high with <strong>STI</strong><br>
The future is here today<br>
Fly high with <strong>STI</strong><br>
Be the best that you can be</p><br>
</div>
 <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5 rounded">
                <div class="card">
                    <h5 class="card-header info-color white-text text-center py-4">
                    <strong> Student sign in</strong>
                    </h5>
                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                    <!-- Form -->
                    <form class="text-center"action="index.php" method="POST">
                    
                        <!-- Email -->
                        <div class="md-form">
                            <input type="email"name="username" id="username" class="form-control" placeholder="E-mail" required>
                        </div>
                        <!-- Password -->
                        <div class="md-form">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div> 
                        <div class="d-flex justify-content-right">
                         
                        <div>
                            <!-- Forgot password -->
                            <a href="reset/forgot-password.php">Forgot password?</a>
                        </div>
                        </div>
                        <!-- Sign in button -->
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0 hover" type="submit" name="login_user">Sign in</button>
                        <!-- Register -->
                        
                        <a target="blank" href="https://twitter.com/sticollege"><i class="fa fa-twitter f"></i></a>
                        <a target="blank" href="https://web.facebook.com/tanauan.sti.edu/"><i class="fa fa-facebook fc"></i></a>
                        <a target="blank" href="https://www.sti.edu/"><i class="fa fa-globe fc"></i></a>
                       
                    </form>
                    <!-- Form -->
                    <div class="d-flex justify-content-right" style="width: 600px;">
                            <?php 
                                if(isset($_SESSION['message'])):
                            ?>
                                <div class="alert alert-<?=$_SESSION['msg_type']?> " style = "height: 50px; width: 300px; margin-right: 20px; text-align: left; ">
                                    <?php
                                        echo $_SESSION['message'];
                                        unset($_SESSION['message']);
                                    ?>
                            </div>
                            <?php endif ?>
                    </div>
                    </div>
                </div>
            </div>
        </div> 
      </div>
  
</div> 
<br> 

 <div class="container test">
        <div class="row no-gutters">
            <!-- <div class="col-md-4 mt-5 rounded"> -->
<!-- <div class="row" style="height: 480px; background-color: #ffffff; margin: 50px;" >
 -->  <div class="col-sm-6 no-gutters vision" style="box-shadow: inset 0 -3em 3em rgba(0,0,0,0.1), 0 0  0 4px rgb(255,255,255),0.3em 0.3em 2em rgba(0,0,0,0.5);  background-image: url(img/vision.jpg); background-position: center;  background-repeat: no-repeat;  height: 400px; width: 200px; margin-right: 0px;"></div>
  <div class="col-sm-6 no-gutters mision" style="box-shadow: inset 0 -3em 3em rgba(0,0,0,0.1), 0 0  0 4px rgb(255,255,255),0.3em 0.3em 2em rgba(0,0,0,0.5);  background-image: url(img/mission.jpg); background-position: center; background-repeat: no-repeat;  height: 400px; width: 200px; margin: 0px;"></div>
</div>
</div>
<br>

   <footer>
      <div id="forf" style="height: 400px; width: 100%; background: white; padding: 100px 0 0 50px;">
      <div class="container">
        <div class="row no-gutters disp">
          <div class="col-sm-6 no-gutters"> 
                <a target = "blank" href="https://web.facebook.com/tanauan.sti.edu/"><i class='fab fa-facebook-f' style='font-size:28px;color:#03539a;margin-left:8px;cursor: pointer;'></i></a>
                    <a target="blank" href="https://twitter.com/sticollege"><i class='fab fa-instagram' style='font-size:28px;color:#03539a;margin-left:8px;cursor: pointer;'></i></a>
                        <a target="blank" href="https://twitter.com/sticollege"><i class='fab fa-twitter' style='font-size:28px;color:#03539a;margin-left:8px;cursor: pointer;'></i></a><br><br>

                <p style="color: black;"> <i class='fa fa-globe' style='font-size:20px;color:black;margin-right:8px'></i>Address: Mabine Ave, Tanauan city, Batangas</p>
                <p style="color: black;"> <i class='fa fa-envelope' style='font-size:20px;color:black;margin-right:8px'></i>E-mail address: www.sti.edu</p>
                 <p style="color: black;"> <i class='fa fa-phone' style='font-size:20px;color:black;margin-right:8px'></i>Contact Number: (043) 778 4682</p>
            


            
          </div>
          <div class="col-sm-6 no-gutters">
           <div id="piechart" style="width: 400px; height: 300px; padding-bottom: 40px;"></div>
        </div>
       </div>
     </div>
   </div>
<div style="height: 45px; background: #f9e215; padding: 7px 0 5px 0px;">
               <p style="color: #06192d; text-align: center;"> Copyright 2020 <i class='fa fa-copyright' style='font-size:15px;color:#06192d;margin-right:8px'></i> STI College Tanauan SSC-Voting System</p>
            </div>
    </footer>
       </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>  