<?php
session_start();


// require("includes/conn.php");
 require("admin/includes/db.php");
 include "check_token.php";


require("classes/SHSVoting.php");


if (isset($_SESSION['ID'])){

                                                            
	 //echo 'welcome'; echo $_SESSION['email'];
	 //echo '<a href = "logout.php">logout</a>';
  // $votersid = $_SESSION['studentid'];
  //                        $year = $_GET['year'];
  //                        $level =  $_SESSION['Level'];
  //                        $sql = "UPDATE status set schoolyear = '$year', Level = '$level', vStatus = 'voted', voters_id = '$votersid' where voters_id = '$votersid' "; 
  //                        $db->query($sql);

$Representatives = $_SESSION['program'];
?>

<?php

            if(isset($_POST['vote'])) {
                $schoolyear = $_POST['schoolyear'];
                $position = $_POST['position'];
                $candidate_id = $_POST['nominee'];
                $voters_id = $_POST['voter_id'];
                $fullname = $_POST['fullname'];
             
        


                $count = count($_POST['nominee']);
                for($i = 0; $i < $count; $i++){
                        
                    $sql = "INSERT INTO votes(schoolyear, position, candidate_id, voters_id, fullname)VALUES('{$schoolyear
                    [$i]}', '{$position[$i]}', '{$candidate_id[$i]}', '{$voters_id[$i]}', '{$fullname[$i]}');"; 

                     $db->query($sql);




                    
                     }
           
                     if($i == $count){
                    $votersid = $_SESSION['studentid'];
                         $year = $_GET['year'];
                         $level =  $_SESSION['Level'];
                         $sql = "UPDATE status set schoolyear = '$year', Level = '$level', vStatus = 'voted', voters_id = '$votersid' where voters_id = '$votersid' "; 
                         $db->query($sql);


                        $_SESSION['message'] = "Vote successful  ";
                        $_SESSION['msg_type'] = "success";
                                                   
                        }
                
            }
          

            ?>






 <!DOCTYPE html>
<html>
<head>
	<title>Senior High SSC Voting</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <link rel="stylesheet" href="css/votingsection5.css">
    <script src="http://code.jquery.com/jquery-3.4.1.js" ></script>
    <link rel="stylesheet" type="text/css" href="admin/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--     <script type="text/javascript">
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

$(document).ready(function(){
     $(document).on("keydown", disableF5);
});
</script>
 -->



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
  div.forbtn button{
   background:  left: 0;
 position: relative;
 margin: 20px 20px 140px 20px!important;
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
    </head>
	
<body>



<!-- 
    		    <header class="header">
        <nav class="navbar  navbar-style">
            <div class="container">
                <div class="navbar-header"> -->

                   <!--  <a href="" class="logo"><img src="logo.png"></a> -->
                   <!--  <div class="navbar-text text">
                            <p><strong>STI COLLEGE TANAUAN SSC VOTING SYSTEM</strong></p>                       
                    </div>
                </div>
            </div>
        
            <i class="fa fa-home" aria-hidden="true" style="font-size:18px;color:#015baa;cursor: pointer; margin-right: 15px">
            <a href="year.php" ></a></i>
       
            	<i class="fas fa-sign-out-alt" style="font-size:17px;color:#015baa;cursor: pointer; margin: 3px">
            <a href="logout.php"  style="font-size:17px;font-weight: 500; color:#015baa;padding-right: 30px;cursor: pointer; font-family: 'Poppins', sans-serif">Logout</a></i>
        </nav>
    </header>   -->


    <nav class="navbar navbar-expand-sm navbar-dark fixed-top ">
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
                                    <a href="SHSyear.php" class="nav-link "><i class='fa fa-home' style='font-size:15px;color:#015baa;margin: 4px'></i>Home</a>
                                </li>


                                <li class="nav-item">
                                    <a href="SHSuser_profile.php" class="nav-link"><i class='far fa-user-circle' style='font-size:15px;color:#015baa;margin: 4px'></i><?php echo  $_SESSION['GetUser']; ?></a>
                                </li>


                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        






    
<br><br><br>
<div class="container">
    <br>
	<!-- <p><strong>Welcome</strong> <?php //echo $_SESSION['GetUser']." ".$_SESSION['lastname']; ?>,</p>
 -->

<?php

ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);


if(isset($_GET['year'])) {
    $schoolyear = $_GET['year'];

?>




<div class="container">
     <h4 style="text-align: center;"> SSC Election for Senior High <br> School Year: <?php echo $schoolyear; ?> </h4>
                  <hr style="background: #025baa;height: 2px;">
     <div class="row">


     <div class="col-md-6 col-md-offset-3 mx-auto" style="max-height: 360px; overflow-y: scroll; border: 1px solid #ccc; border-radius: 5px; margin-left: 20px;  ">
        <?php  include("classes/SHSResult.php");

     $readResults = new SHS_Result();
    $rtnReadPos = $readResults->READ_POS_BY_YEAR($schoolyear);
    ?>
<br>

            <div id="refresh" style="margin-right: 90px;"> <h4 style="margin-left: 30px; text-align: center;"> Candidate Profile

                <hr style="background: #ffc107; height: 2px;width: 300px; margin-right: 55px "></h4></div>   
     

            <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
    

                    <p><b><?php echo "<p style = 'color: black;'>".$rowPos['position']."</p>"; ?></b></p>

                        <?php
                        $ReadYearPos = new SHS_Result();
                        $rtnReadYearPos = $ReadYearPos->READ_NOM_BY_YEAR_POS($schoolyear, $rowPos['position']);

                        ?>
                        <div class="table-responsive" style="width: 400px;">
                            <?php if($rtnReadYearPos) { ?>
                           
                                <?php while($rowCountVotes = $rtnReadYearPos->fetch_assoc()) { ?>
                                    



                                    <?php
                                    $countVotes = new SHS_Result();
                                    $rtnCountVotes = $countVotes->COUNT_VOTES($rowCountVotes['id']);
                                        // $win=$rtnCountVotes->num_rows;
                                    ?><hr style="background: #ffc107;">
                                
                                    

                                        <img src= "<?php echo $rowCountVotes['C_image']; ?>"  style="height: 100px; width: 110px; border-radius: 50%; margin-left:  50px;" /> 
                                        <p><?php echo "<strong style = 'color: #062d50'>".$rowCountVotes['Firstname']." ".$rowCountVotes['MI']." ".$rowCountVotes['Lastname']."</strong>"; ?><br>
                                        <strong>Partylist name: </strong><?php echo $rowCountVotes['partylist']; ?><br>
                                        <strong>Achievements: </strong><?php echo $rowCountVotes['Cprofile']; ?></p>
                                   
                                
                                    

                                <?php } //End while ?>
                           
                            <?php $rtnReadYearPos->free(); } //End if ?><hr style="background: #ffc107; height: 2px">
                        </div>
                             <?php } //End while ?>
                              

         </div>



	    	


        <?php if($rtnReadPos) { ?>
   
<?php

$readPos = new SHSVoting();
$rtnReadPos = $readPos->READ_POSITION($schoolyear);


$readPos1 = new SHSVoting();
$rtnReadPos1 = $readPos1->READ_REP_POSITION($schoolyear,$Representatives);
?>
        


        <div class="col-md-6 col-md-offset-3 mx-auto" style="max-height: 360px; overflow-y: scroll; border: 1px solid #ccc; border-radius: 5px; margin-left: 20px; ">

            <br>
            <div id="refresh" style="margin-right: 90px;"> <h4 style="margin-left: 30px; text-align: center;"> Vote Candidate

                <hr style="background: #ffc107; height: 2px;width: 300px; margin-right: 55px "></h4></div>   
               <form action="" method="POST" role="form">
            <div class="voting-con" >

               

                <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
             <!--    <form action="vote.php>" method="POST" role="form"> -->
                    <p class="help-block"><b><?php echo $rowPos['position']; ?></b></p>
                        <?php
                        $readNominee = new SHSVoting();
                        $rtnReadNominee = $readNominee->READ_NOMINEES($schoolyear, $rowPos['position']);
                        ?>

                        <?php if($rtnReadNominee) { ?>
                            <div class="form-group" >
                                <select name="nominee[]" class="form-control">
                                    <option value="">*****Select Candidate*****</option>
                                    <?php while($rowNominee = $rtnReadNominee->fetch_assoc()) { ?>
                                    <option style="margin: 50px;" value="<?php echo $rowNominee['id']; ?>"><?php echo "<strong>". $rowNominee['partylist']."</strong>"." - ".$rowNominee['Firstname']." ".$rowNominee['MI']." ".$rowNominee['Lastname']; ?></option>

                                    <?php } //End while $_SESSION['program'] ?>
                                </select>
                            </div>
                        <?php } $voter_id=$_SESSION['ID'];
                        //End if  ?>
                        <input type="hidden" name="schoolyear[]" value="<?php echo $schoolyear; ?>">
                        <input type="hidden" name="position[]" value="<?php echo $rowPos['position']; ?>">
                        <input type="hidden" name="voter_id[]" value="<?php echo $voter_id; ?>">
                         <input type="hidden" name="fullname[]" value="<?php echo $rowNominee['Firstname']; ?>"> 


 <?php
                        $readNominee = new SHSVoting();
                        $rtnReadNominee = $readNominee->READ_NOMINEES($schoolyear, $rowPos['position']);
                        ?>
 
                  <?php
                    $voter_id=$_SESSION['ID'];
                    $validateVote = new SHSVoting();
                    $rtnValVote = $validateVote->VALIDATE_VOTE($schoolyear, $rowPos['position'],$voter_id );
                    ?> 
               <!--  </form> --><hr /style="background: #ffc107">
                <?php } //End while ?>

<!-- For representatives -->

                                <?php while($rowPos1 = $rtnReadPos1->fetch_assoc()) { ?>
             <!--    <form action="vote.php>" method="POST" role="form"> -->
                    <p class="help-block"><b><?php echo $rowPos1['position']; ?></b></p>
                        <?php
                        $readNominee = new SHSVoting();
                        $rtnReadNominee = $readNominee->READ_NOMINEES($schoolyear, $rowPos1['position'], $Representatives);
                        ?>

                        <?php if($rtnReadNominee) { ?>
                            <div class="form-group" >
                                <select name="nominee[]" class="form-control">
                                    <option value="">*****Select Candidate*****</option>
                                    <?php while($rowNominee = $rtnReadNominee->fetch_assoc()) { ?>
                                    <option style="margin: 50px;" value="<?php echo $rowNominee['id']; ?>"><?php echo "<strong>". $rowNominee['partylist']."</strong>"." - ".$rowNominee['Firstname']." ".$rowNominee['MI']." ".$rowNominee['Lastname']; ?></option>

                                    <?php } //End while $_SESSION['program'] ?>
                                </select>
                            </div>
                        <?php } $voter_id=$_SESSION['ID'];
                        //End if  ?>
                        <input type="hidden" name="schoolyear[]" value="<?php echo $schoolyear; ?>">
                        <input type="hidden" name="position[]" value="<?php echo $rowPos1['position']; ?>">
                        <input type="hidden" name="voter_id[]" value="<?php echo $voter_id; ?>">
                         <input type="hidden" name="fullname[]" value="<?php echo $rowNominee['Firstname']; ?>"> 


 <?php
                        $readNominee = new SHSVoting();
                        $rtnReadNominee = $readNominee->READ_NOMINEES($schoolyear, $rowPos['position'], $Representatives);
                        ?>
 
                  <?php
                    $voter_id=$_SESSION['ID'];
                    $validateVote = new SHSVoting();
                    $rtnValVote = $validateVote->VALIDATE_VOTE($schoolyear, $rowPos['position'],$voter_id );
                    ?> 
               <!--  </form> --><hr /style="background: #ffc107">
                <?php } //End while ?> <!-- end For representatives -->


            </div>
              
                       <div class="forbtn">
                               <!-- <?php if($rtnValVote->num_rows > 0) { ?>
                                <?php echo "  <button  type=''  name='' class='btn btn-default disabled' title='Sorry you have casted your vote already.' style =' cursor: not-allowed; width: 300px; margin: 20px 0 60px 105px;'>" ; ?>
                                <?php } else { ?>
                                <?php echo " <button  type='submit'  name='vote' onClick ='return Confirm();' class='btn btn-info' style = 'width: 300px;  margin: 20px 0 60px 105px;'>"; ?>
                                <?php } //End if ?> -->


                           <!-- <button  type='submit'  name='vote' onClick ='return Confirm();' class='btn btn-info' style = 'width: 300px;  margin: 20px 0 60px 105px;'> Vote
                        </button> -->
                       <!-- <button  type='submit'  name='vote' data-toggle="modal" data-target="#mymodal" class='btn btn-primary' style = 'width: 300px;  margin: 20px 0 60px 105px;' > Vote
                        </button>-->
                         <input name = "check" value="Vote" data-toggle="modal" data-target="#mymodal" class='btn btn-info' style = 'width: 300px;  margin: 20px 0 60px 105px;'><br><br>
                    </form>
                   
                     <div class="modal fade" id="mymodal">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content mod">
                                <div class="modal-header">
                                    <p>You have selected:</p>
                                </div>
                                <div class="modal-body">
                                   <div class="table-responsive" id="modal">
                                   <?php
                                          if (isset($_POST['check'])) {
                                           $position = $_POST['position'];
                                           $fullname = $_POST['fullname'];
                                           $candidate_id = $_POST['nominee'];
                                  $sql = "SELECT * from tbl_nominees "; 
                                  $res2 = mysqli_query($db, $sql);
                                  $row2  = $res2->fetch_array();
                                           
                $count = count($_POST['nominee']);
                for($i = 0; $i < $count; $i++){
                                  $sql = "SELECT * from tbl_nominees where id = '$candidate_id[$i]'"; 
                                  $res2 = mysqli_query($db, $sql);
                                  $row2  = $res2->fetch_array();
                   echo $position[$i]. ":  ".$row2['Firstname']." ".$row2['Lastname'] .'<br>';
                        
                    
                     }
                                          }
                                    ?>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button  type="submit"  name="vote" onClick ="return Confirm();" class="btn btn-primary" style="width: 100px;" > Vote
                        </button>
                                    <input class="btn btn-warning" data-dismiss="modal" value="Close" style="width: 100px;">
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <?php } //End if ?>
    </div>
</div>








</div>


 <div class="footer" style="position: fixed; left: 0;bottom: 0; width: 100%; text-align:right;color: #054b88; justify-content: left; font-size: 11px">
    <div class="">
<p>
            Copyright 2020 @
            STI College Tanauan SSC-Voting System

   </p>
</div>
</div>


        <script type="text/javascript">
            function Confirm(){
                var x = confirm("Are you sure? Votes can't be modified when you click OK.");
                if(x==true){
                    return true;
                }else{
                    return false;
                }

            }
        </script>
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
            swal({ title: "<?php echo $_SESSION['message']; ?>",
            text:  "Thank you!",
            type: "<?php echo $_SESSION['msg_type']; ?>"}).then(okay => {
        if (okay) {
            window.location.href = "SHSyear.php";
                    }
            });
        </script>
                     
        <?php
             echo $_SESSION['message'];
             unset($_SESSION['message']);
            }
         ?>



 <?php } 
else{
    //header('location: logout.php');
      exit();
}


 ?>  

<?php
 }
else{
      header("location: logout.php");
        exit();
}
?>



                                 
                               
<!-- <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script> -->


<!-- SELECT tbl_nominees.position as Position, CONCAT(tbl_nominees.Firstname,' ', tbl_nominees.MI,'. ', tbl_nominees.Lastname) as Fullname , votes.schoolyear as Schoolyear FROM tbl_nominees INNER JOIN votes ON votes.candidate_id = tbl_nominees.id where voters_id = 49
 -->

