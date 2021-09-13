<?php 
session_start();
require_once('../includes/conn.php');
$email = $_SESSION['email'];
if($email == false){
  header('Location: ../index.php');
}
$errors = array();
//$email = $_SESSION['email'];
   //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        session_unset();
        $otp_code = mysqli_real_escape_string($mysqli, $_POST['otp']);
        $check_code = "SELECT * FROM tbl_addvoters WHERE code = $otp_code";
        $code_res = mysqli_query($mysqli, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";

        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../css/mdb.min.css" rel="stylesheet">
     <link href="../css/style.min.css" rel="stylesheet">

     <style type="text/css">
         @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
html,body{
    background: #dee2e6;
    font-family: 'Poppins', sans-serif;
}
::selection{
    color: #fff;
    background: #6665ee;
}
.container{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.container .form{
    background: #fff;
    padding: 30px 35px;
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.container .form form .form-control{
    height: 40px;
    font-size: 15px;
}
.container .form form .forget-pass{
    margin: -15px 0 15px 0;
}
.container .form form .forget-pass a{
   font-size: 15px;
}
.container .form form .button{
    background: #6665ee;
    color: #fff;
    font-size: 17px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.container .form form .button:hover{
    background: #5757d1;
}
.container .form form .link{
    padding: 5px 0;
}
.container .form form .link a{
    color: #6665ee;
}
.container .login-form form p{
    font-size: 14px;
}
.container .row .alert{
    font-size: 14px;
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
}

.navbar-dark{
  width: 100%;
  height: 60px;
}

.navbar-dark .navbar-brand{
  color: #025baa
}
.card{
    height: 350px;
 width: 450px;
  margin-top: 60px;
 }

     </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark ">
                    
                    <!--    <a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->
                     

                           <p style="position: auto; padding:10px 0 0 30px; font-size: 19px; color: #025baa; font-weight: normal; font-family: ; "><strong>STI COLLEGE TANAUAN
                            SSC VOTING SYSTEM</strong></p>

                      
                        
                    
                </nav>



     <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5 rounded">
                <div class="card">
                     <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Code Verificattion</strong>
                    </h5>
                    <div class="card-body px-lg-5 pt-0">
                     <form action="reset-code.php" class="text-center" method="POST" autocomplete="">
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                            <?php echo $_SESSION['info']; 
                           
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <p class="text-center">Enter the otp code</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                   <div class=" form form">
                        <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                    </div>
                    <div class="md-form">
                        <input class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="check-reset-otp" value="Submit">
                    </div>
                </form>
            </div>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>