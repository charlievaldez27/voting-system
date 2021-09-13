<?php
session_start();
//include('header.php');

include("admin/includes/db.php");
include "check_token.php";
//Include class Voting
require("classes/Voting.php");

if (isset($_SESSION['ID'])){
	 //echo 'welcome'; echo $_SESSION['email'];
	 //echo '<a href = "logout.php">logout</a>';


   
 $id= $_SESSION['ID'];
 $active = "";
 $query = "SELECT schoolyear from tbl_schoolyear where Status = 'Running'";
 $result = mysqli_query($db, $query);
 $row  = $result->fetch_array();
 $active = $row['schoolyear']; 
 
    $sql = " SELECT tbl_nominees.position as Position, tbl_nominees.partylist as PartyList, CONCAT(tbl_nominees.Firstname,' ', tbl_nominees.MI,'. ', tbl_nominees.Lastname) as Fullname , votes.schoolyear as Schoolyear FROM tbl_nominees INNER JOIN votes ON tbl_nominees.id = votes.candidate_id where votes.schoolyear = '$active' and voters_id = '$id' ";
    $results = mysqli_query($db, $sql);

    //checking of running election
    $query1 = "SELECT * from tbl_schoolyear where Status = 'Running'";
    $res = mysqli_query($db, $query1);

      //checking if the time is not yet ended

    $query2 = "SELECT timeEnded from tbl_schoolyear where Status = 'Running' ";
    $res2 = mysqli_query($db, $query2);
     $row2  = $res2->fetch_array();
      $timeEnded = $row2['timeEnded'];
     $ended = date('Y/m/d H:i:sa',strtotime($timeEnded)) .'<br>';
     $active = $row['schoolyear']; 
     date_default_timezone_set('Asia/Manila');      
     $date=date("Y/m/d h:i:sa");
                    
?>

 <!DOCTYPE html>
<html>
<head>
	<title> Tertiary SSC Voting</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<link rel="stylesheet" href="css/schoolyear5.css">
	<script src="http://code.jquery.com/jquery-3.4.1.js" ></script>
    <link rel="stylesheet" type="text/css" href="admin/fontawesome/css/all.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
	    <script type="text/javascript" src="admin/js/jquery.js"></script>

 <style>
 .main{
  width: 100%;
  height: 100%;
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
  div.midbutton{
    position: absolute;
    right: 0;
    margin-right: 60px;

  }
  div input.btns{
padding: 15px 35px 15px 35px; 
 margin: 180px 0  0 500px; 
 font-weight: 600; 
 font-size: 15px;
 border-radius: 10px; 
 color: white; 
 background: transparent; 
 border: 5px solid #d8a304;
 transition: .4s;
 text-align: center;
 width: 280px;
}
div.con{
    height: 600px!important;
    width: 100%;
}
div.col1{
    width: 130px!important;
    height: 100px!important;
    background:!important;
    background-size: 400px!important;
        position: absolute!important;
    left: 0!important;
    margin-left: 10px!important;
}
div.col2{
    width: 130px!important;
    height: 100px!important;
    background:!important;
    background-size: 400px!important;
    position: absolute!important;
    left: 0!important;
    margin-left: 10px!important;
}
div.col3{
    width: 130px!important;
    height: 100px!important;
    background:!important;
    margin-left: 300px!important;
    background-size: 400px!important;
        position: absolute!important;
    left: 0!important;
    margin-left: 10px!important;
  margin: 400px 0px 50px 10px!important;
}
div.p1 p{
 width: 300px;
 position: absolute;
 right: 0;
 font-size: 12px;
 padding: 50px 50px 0px 0px;  
 margin-right: -40px!important;   
  }
  div.p2 p{
 width: 300px;
    position: absolute;
    right: 0;
    padding: 120px 60px 50px 0px;     
    font-size: 12px;   
     text-align: left!important;
      margin-right: -40px!important;   
  
  }
  div.p3 p{
    width: 300px;
 position: absolute;
 right: 0;
 font-size: 12px;
  padding: 250px 20px 50px 0px;
   margin-right: -40px!important;   
  
  }
  div.disp{
    display: flex;
    ;
  }
  div.mod {
    width: 400px;
  
  }
  table thead th,table tbody td{
    padding: 3px 10px 3px 10px;
    text-align: left;
    align-items: center;
    border-bottom: 1px solid #ccc;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 10px;
}
table thead th{
    background: #0a57a9;
    color: white;
    text-transform: uppercase;
    position: sticky;
    text-align: center;
    top: -1px;
    font-size: 10px;
    border-radius: 5px;

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
.btns{
padding: 15px 35px 15px 35px; 
 margin: 180px 0  0 500px; 
 font-weight: 600; 
 font-size: 25px;
 border-radius: 10px; 
 color: white; 
 background: transparent; 
 border: 5px solid #d8a304;
 transition: .4s;
 width: 440px;
 text-align: center;    
}

.btns:hover{
 color: #d8a304;
 border: 5px solid white;
 transition: .7s;
}
.modal-md{
    max-width: 48%!important;
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
</style>


</head>
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
                                    <a href="year.php" class="nav-link hovers"><i class='fa fa-home' style='font-size:15px;color:#015baa;margin: 4px'></i>Home</a>
                                </li>


                                <li class="nav-item">
                                    <a href="user_profile.php" class="nav-link"><i class='far fa-user-circle' style='font-size:15px;color:#015baa;margin: 4px'></i><?php echo  $_SESSION['GetUser']; ?></a>
                                </li>
                    <?php
                    if(mysqli_num_rows($res) == ""){?>
                        

                    <?php } else { ?>
               
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Results
                                   </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                       <a class="dropdown-item" href="SHS.VR.php">Senior High</a>
                                       <a class="dropdown-item" href="votingResult.php">Tertiary</a>
                                       
                                     </div>                             
                                </li>
                        <?php } ?>

                                <li class="nav-item">
                                    <a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt" style='font-size:15px;color:#015baa;margin: 4px'></i>Logout</a>
                                </li>


                                
                            </ul>
                        </div>
                    
                </nav>
        


<section class="main">

<div style="height: 500px; width: 100%; background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.7)), url(img/background1.jpg); background-repeat: no-repeat; background-position: center; background-size: cover; padding-top: 10px;">


<?php
$readSchoolyear = new Voting();
$rtnYear = $readSchoolyear->READ_YEAR_FOR_VOTING();
?>

<!-- div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 mx-auto"> -->
           <!--  <h3 style="text-align: center;">Select School Year</h3><hr / style="background: #ffc107"> -->
        <!--  <p><strong>Welcome </strong><?php //echo  $_SESSION['GetUser']; ?></p> -->
            <?php if($rtnYear) { ?>
            <form action="votingsection.php" method="GET" role="form">
                <div class="form-group">
                    <!-- <label for="year">School Year</label> -->
                    <select required class="form-control" id = "getyears" name="year" hidden >
                       
                        <?php while($rowOrg = $rtnYear->fetch_assoc()) { ?>
                        <option value="<?php echo $rowOrg['schoolyear']; ?>" hidden><?php echo $rowOrg['schoolyear']; ?></option>
                        <?php }//echo "fgdfgdsgd". $school = $_SESSION['schoolyear'] = $rowOrg['schoolyear']; //End while ?>
                    </select>
                </div>
                 <div class="midbutton">
                <?php 
                    
                    if(mysqli_num_rows($res) == ""){?>
                        <input type="" name="submit" value="Voting is not yet begun" class="btns">

                    <?php } else {?>

                    <?php 
                    date_default_timezone_set('Asia/Manila');      
                       $date=date("Y/m/d h:i:sa");
                    if($date > $ended){?>
                        <input type="" name="submit" value="Voting is over!" class="btns">

                    <?php } else {?>



               
                     <div class="form-group" style="">
                   <?php
                    $rowOrg1 = $rtnYear->fetch_assoc();
                    
                     $schoolyear1 = $_COOKIE['ResultYear'];
                    $id= $_SESSION['studentid'];
                    $query="SELECT * from status WHERE voters_id='".$id."' and vStatus ='voted' and schoolyear = '".$schoolyear1."'";
                    $ex=mysqli_query($db,$query);
                    if(mysqli_num_rows($ex) == ""){

                     
                ?>
               
                <input type="submit" name="submit" value="Go to voting section  " class="btns"><br><br>
               
                <?php } else{ ?>
                    
                    <div class="modal fade" id="mymodal">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content mod">
                                <div class="modal-header">
                                    
                                </div>
                                <div class="modal-body">
                                   <div class="table-responsive" id="modal">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Position</th>
                                                    <th>Party List</th>
                                                    <th>Fullname</th>
                                                    <th>Schoolyear</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            if(mysqli_num_rows($results) > 0){
                                                while($row = mysqli_fetch_array($results)){
                                            
                                            ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['Position'] ?></td>
                                                <td><?php echo $row['PartyList'] ?></td>
                                                <td><?php echo $row['Fullname'] ?></td>
                                                <td><?php echo $row['Schoolyear'] ?></td>
                                                
                                            </tr>
                                        </tbody>
                                        <?php }} ?>
                                        </table>
                                        <!-- <span><?php echo $error; ?></span> -->


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-primary" data-dismiss="modal" value="Close">
                                </div>
                            </div>
                        </div>
                    </div>
                   <!-- <p style = "  margin: 180px 0  0 500px; color: #d8a304; font-size: 30px">You already casted your vote</p> -->
                   <div class="md-form">
                            <input value="You Already Casted Your Votes" data-toggle="modal" data-target="#mymodal" class="btns"><br><br>
                        </div>
                   <?php }  ?> 

                </div>
            <?php }
          }?>   
        </div>
            </form>
            </div>


                <?php $rtnYear->free(); ?>
            <?php } //End if ?>
<!--         </div>
    </div>
</div> -->






                <!--  for result -->

            <div class="con" style="height: 920px; width: 100%;">
                     <div class="row no-gutters disp">
                        <div class="col-sm-4 col1" style="background-image: url(img/4.jpg);background-repeat: round; position: absolute; height: 300px; width: 27%; margin: 30px 0 0 25px; ">
                           
                        </div>
                        <div class="p1">
                         <p style="margin: 35px 0 0 450px;"  >“Every morning we get a chance to be different. 
                            <br>A chance to change. A chance to be better. Your past is your past.
                            <br> Leave it there. Get on with the future part.”
                            <br> ― Nicole Williams, Lost & Found 
                        </p>
                        </div>

                        <div class="col-sm-4 col2" style="background-image: url(img/3.jpg);background-repeat: round; position: absolute; height: 300px; width: 27%; margin: 200px 0 0 960px; ">
                           
                        </div>
                        <div class="p2">
                            <p class="col2" style="margin: 150px 0 0 520px; text-align: right;"  >“Challenge yourself everyday to do better and be better. 
                            <br>Remember, growth starts with a decision to move
                            <br> beyond your present circumstances.” 
                            <br> ― Robert Tew
                        </p>
                    </div>


                    <div class="col-sm-4 col3" style="background-image: url(img/5.jpg);background-repeat: round; position: absolute; height: 300px; width: 27%; margin: 450px 0 0 225px; ">
                           
                        </div>
                        <div class="p3">
                         <p class="col3" style="margin: 200px 0 0 650px;"  > 
                            <br>"A life spent making mistakes is not only more honorable,
                            <br> but more useful than a life spent doing nothing”
                            <br> ― George Bernhard Shaw

                        </p>
                        </div>

                    </div>
            </div>
<footer>
            <div style="height: 300px; background: #0b2b4e; padding: 40px 0 0 50px;">
                <a target = "blank" href="https://web.facebook.com/tanauan.sti.edu/"><i class='fab fa-facebook-f' style='font-size:28px;color:#f9e215;margin-left:8px;cursor: pointer;'></i></a>
                    <a target="blank" href="https://twitter.com/sticollege"><i class='fab fa-instagram' style='font-size:28px;color:#f9e215;margin-left:8px;cursor: pointer;'></i></a>
                        <a target="blank" href="https://twitter.com/sticollege"><i class='fab fa-twitter' style='font-size:28px;color:#f9e215;margin-left:8px;cursor: pointer;'></i></a><br><br>

                <p style="color: #ccc;"> <i class='fa fa-globe' style='font-size:20px;color:#ccc;margin-right:8px'></i>Mabine Ave, Tanauan city, Batangas</p>
                <p style="color: #ccc;"> <i class='fa fa-envelope' style='font-size:20px;color:#ccc;margin-right:8px'></i>admissions@tanauan.sti.edu</p>
                 <p style="color: #ccc;"> <i class='fa fa-phone' style='font-size:20px;color:#ccc;margin-right:8px'></i>(043) 778-4682 / 4781</p>
            </div>


            <div style="height: 45px; background: #f9e215; padding: 7px 0 5px 0px;  left: 0;bottom: 0; width: 100%;">
               <p style="color: #06192d; text-align: center;"> Copyright 2020 <i class='fa fa-copyright' style='font-size:15px;color:#06192d;margin-right:8px'></i> STI College Tanauan SSC-Voting System</p>
            </div>

</footer>

</section>




<!-- <div class="footer" style="position: fixed; left: 0;bottom: 0; width: 100%; text-align:right;color: #054b88; justify-content: left; font-size: 11px">
    <div class="">
<p>
            Copyright 2019 @
            STI College Tanauan SSC-Voting System

   </p>
</div> -->





	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
</body>
</html>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

        if(isset($_SESSION['message'])){
?>
        <script>
            swal({
            title: "<?php echo $_SESSION['message']; ?>",
            text: "Thank you!",
            icon: "<?php echo $_SESSION['msg_type']; ?>",
            button: "show!",
            });
        </script>   
                     
    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        }
    ?>
<script type="text/javascript">
    window.onclose = closing;

function closing(){
  $.ajax({
     url: 'yoururl.php',
     data: yourdata,
     success: function(content){
          // empty
     }
  })
}
</script>
 <script type="text/javascript" src="admin/js/jquery.js"></script>
<script type="text/javascript">
    var currentYear = $('#getyears').val();

    // window.location.href = "maintest.php?sy="+currentSY+"";
    $(document).ready(function(){

        createCookie("ResultYear",currentYear);

    });
    function createCookie(name,value){
        document.cookie = escape(name) + "="+ escape(value);
    }

</script>

<?php } else {header('location: index.php');} ?>