<?php



require("includes/db.php");


require("class/Result.php");

?>

 <!DOCTYPE html>
<html>
<head>
	<title>Vote results</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<link rel="stylesheet" href="print1.css">
	<script src="http://code.jquery.com/jquery-3.4.1.js" ></script>
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>

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




     <nav class="navbar navbar-expand-sm navbar-dark ">
                    
                      <!--   <a href="" class = "navbar-brand"><img id="logo" src="logo.png"></a> -->


                          <p style=" padding-top: 17px; font-size: 20px; color: #025baa;"><strong>STI COLLEGE TANAUAN <br>
                            SSC VOTING SYSTEM</strong></p>
                            
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                         aria-controls="navbarSupportedContent" aria-expanded ="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                         </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">

                                <li class="nav-item">
                                    <a href="home.php" class="nav-link"><i class='fas fa-home' style='font-size:13px;color:#015baa;margin: 4px'></i> home   </a>
                                    </li>
     
                                    <li class="nav-item">
                                        <a href="viewresults.php" class="nav-link "><i class='fas fa-poll-h' style='font-size:13px;color:#015baa;margin: 4px'></i>View Result</a>
                                    </li>

                                    <li class="nav-item">
                                        <button onclick=" document.getElementById('show_title').style.display='flex'; myFunction();  document.getElementById('show_title').style.display='none';" style="font-weight: 600; background: transparent; border: none;" class="nav-link hovers"><i class="fas fa-print " style='font-size:13px;color:#015baa;margin: 4px'></i>Print</button>
                                    </li>

                                    <li class="nav-item">
                                        <a href="includes/logout.php" class="nav-link"><i class="fas fa-sign-out-alt" style='font-size:13px;color:#015baa;margin: 4px'></i>Logout</a>
                                    </li>
                            
                            </ul>

                        </div>

                    
                </nav>

                <style type="text/css">
                   .navbar-dark .navbar-nav .nav-item .hovers:hover{
  background: #d39e00 !important;
  color:  #ccc;
  border-radius: 5px;
  transition: .8s;
                </style>


 
           <!--  <a href="viewresults.php"><i class="" aria-hidden="true" style="font-size:20px;color:#015baa;cursor: pointer; margin: px">view Result</i></a> -->
               <!--  <i class="fa fa-sign-out" style="font-size:20px;color:#015baa;cursor: pointer; margin: 3px; float: right">
            <a href="logout.php"  style="font-size:17px;color:#015baa;padding-right: 30px;cursor: pointer; font-family: 'Poppins', sans-serif">Logout</a></i> -->
        </nav>
 <div class="navbar-text text" id="show_title" style="display: none; width: ">
                            <p style="padding-left: 30px"><strong>STI COLLEGE TANAUAN SSC VOTE RESULTS</strong>
                             <h1 style="color: black; font-size: 15px; padding-left: 300px;"><?php date_default_timezone_set('Asia/Manila'); echo date('F j, Y g:i:sa'); ?> </h1></p>                       
                    </div>
            
           


                 <!--    <a href="" class="logo"><img src="logo.png"></a> -->

 
<br><br><br>
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <?php
            if(!isset($_GET['schoolyear'])) {
                echo "<div class='alert alert-warning'>Please select schoolyear and click submit to show vote result.</div>";
            } else {
                $schoolyear = trim($_GET['schoolyear']);
                ?>
                <?php
                $readPos = new Result();
                $rtnReadPos = $readPos->READ_POS_BY_YEAR($schoolyear);
                ?>

                <?php if($rtnReadPos) { ?>

                    <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
                        <h5><?php echo $rowPos['position']; ?></h5>

                        <?php
                        $ReadYearPos = new Result();
                        $rtnReadYearPos = $ReadYearPos->READ_NOM_BY_YEAR_POS($schoolyear, $rowPos['position']);
                        ?>

                        <div class="table-responsive">
                            <?php if($rtnReadYearPos) { ?>
                            <table class="table table-condensed" style="text-align: center; background: #1370c1; color: #f9f6f6; font-family: century gothic; border-radius: 5px">
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th>PartyList</th>
                                    <th>Name</th>
                                    <th>Votes</th>
                                </tr>
                            </table>
                                <?php while($rowCountVotes = $rtnReadYearPos->fetch_assoc()) { ?>




                                    <?php
                                    $countVotes = new Result();
                                    $rtnCountVotes = $countVotes->COUNT_VOTES($rowCountVotes['id']);
                                        // $win=$rtnCountVotes->num_rows;
                                    ?>
                                    <table style="text-align: center; font-family: century gothic; font-size: 17px">

                                    <tr>

                                        <!-- <td style="width: 15%;"><?php echo $rowCountVotes['id']; ?></td> -->
                                         <td style="width:370px;"><?php echo $rowCountVotes['partylist']; ?></td>
                                        <td style="width: 440px;"><?php echo $rowCountVotes['Firstname']." ".$rowCountVotes['MI']." " .$rowCountVotes['Lastname']; ?></td>
                                        <td style="width: 230px;"><?php echo $rtnCountVotes->num_rows; ?></td>

                                    </tr>





                                <?php } //End while ?>
                            </table>
                            <?php $rtnReadYearPos->free(); } //End if ?><hr style="background: #ffc107">
                        </div>

                    <?php } //End while ?>

                    <?php $rtnReadPos->free(); } //End if ?>

            <?php } //End if ?>
        </div>



    </div>
</div>





     <div class="footer" style="position: fixed; left: 0;bottom: 0; width: 100%; text-align:right;color: #054b88; justify-content: left; font-size: 11px">
    <div class="">
<p>
            Copyright 2019 @
            STI College Tanauan SSC-Voting System

   </p>
</div>
</div>
<br><br><br>

<!-- <script type="text/javascript">
    function goBack(){
        window.history.back();
    }
</script> -->

<script type="text/javascript">
    
    function myFunction() {
  window.print();
}
</script>



</body>
</html>


