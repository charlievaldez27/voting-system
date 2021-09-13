<?php 
session_start();
require_once('../includes/conn.php');
$email = "";
$name = "";
$errors = array();
 if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $check_email = "SELECT * FROM tbl_addvoters WHERE email='$email'";
        $run_sql = mysqli_query($mysqli, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE tbl_addvoters SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($mysqli, $insert_code);
            if($run_query){
               // $mail1 = "valdezcharlie927@gmail.com";
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                if($email){

                    require_once('../PHPMailer/PHPMailerAutoload.php');
                    include_once('../PHPMailer/class.phpmailer.php');
                    require_once('../PHPMailer/class.smtp.php');

                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = '465';
                    $mail->isHTML();
                    $mail->Username = 'sscvoting2020@gmail.com';
                    $mail->Password = 'webhostapp2020';
                    $mail->SetFrom('sscvoting2020@gmail.com');
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    $mail->AddAddress($email);
                    $mail->Send();

                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
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
  .container-fluid{
    height: 300px;
 width: 550px;
  margin-top: 60px;
  padding-left: 50px!important;
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
    height: 300px;
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
                    <strong>Forgot Password</strong>
                    </h5>
                    <div class="card-body px-lg-5 pt-0">
                     <form action="forgot-password.php" class="text-center" method="POST" autocomplete="">
                    <p class="text-center">Enter your email address</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="md-form">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="md-form">
                        <input class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
                    </div>
                </div>
            </div>
        </div>
   
    
</body>
</html>