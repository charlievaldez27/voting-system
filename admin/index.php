<?php
session_start();
require_once('includes/connect.php');
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $_SESSION['login_user'] = $username;
    $query = ("SELECT * from tbl_adminlogin where username = '$username' and password = '$password'");
    $result = mysqli_query($mysqli, $query);
       $count = mysqli_num_rows($result);
    if($count > 0) {
        $row  = $result->fetch_array();
         $_SESSION['USER_ID'] = $row['user_id'];
         $_SESSION['user'] = $row['username'];
         $_SESSION['pass'] = $row['password'];
         if ($row['username'] == $username && $row['password'] == $password) {
             header('location: Home.php');
            exit();
         }else{
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.min.css" rel="stylesheet">
     <link href="../css/style.min.css" rel="stylesheet">
    <title>admin login</title>
</head>


<style type="text/css">
    
    @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900');
body{
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  background: #dee2e6;
  color:#666;
  margin: 0;
  padding: 0;
}
.header{
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
    

}
.text{
  height: 20px;
  color: #015baa;
  font-size: 20px;
}
.login-container{
  height: 100vh;
  width: 100%;
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
  color: #0856a9;
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
.card{
    height: 400px;
 width: 450px;
  margin-top: 60px;
 }


</style>
 <header class="header">
        <nav class="navbar navbar-style">
            <div class="container">
                <div class="navbar-header">

                   <!--  <a href="" class="logo"><img src="logo.png"></a> -->
                    <div class="navbar-text text">
                        
                            <p style="ppx;"><strong>STI COLLEGE TANAUAN SSC VOTING SYSTEM</strong></p>
                       
                    </div>
                </div>
            </div>
        </nav>
    </header>    


<body>

   


  

     <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5 rounded">
                <div class="card">
                    <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Admin sign in</strong>
                    </h5>
                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                    <!-- Form -->
                    <form class="text-center"action="index.php" method="POST">
                        <!-- Email -->
                        <div class="md-form">
                            <input type="text"name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                        <!-- Password -->
                        <div class="md-form">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div> 
                        <div class="d-flex justify-content-around">

                        <div>
                            <!-- Forgot password -->
                            <!-- <a href="forgotpass.php">Forgot password?</a> -->
                        </div>
                        </div>
                        <!-- Sign in button -->
                        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submit">Sign in</button>
                    
          
                    </form>
                   <div class="d-flex justify-content-right" style="width: 500px;">
                            <?php 
                                if(isset($_SESSION['message'])):
                            ?>
                                <div class="alert alert-<?=$_SESSION['msg_type']?> " style = "background: #ef7070;color: white; width: 358px; text-align: center; ">
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

    <footer></footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>