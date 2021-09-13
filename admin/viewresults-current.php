<?php
require("../includes/pdo.php");
                $sql = "SELECT schoolyear from tbl_schoolyear where Status= 'Running'";
                 
                

                try{ //for partylist dropdown
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                        }catch(Exception $ex){
                        echo ($ex -> getMessage());
                }

?>
<?php
session_start();
if (isset($_SESSION['USER_ID'])){
$schoolyear = $_COOKIE['cur-sy'];
 
//for graph
  $query ="SELECT vStatus, count(*) as number from status where Status = 'Enrolled' and Level = 'Tertiary' and schoolyear = '$schoolyear' group by vStatus";
$result = mysqli_query($db,$query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    
    <script src="http://code.jquery.com/jquery-3.4.1.js" ></script> 
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="viewresults4.css">

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="application/javascript">

        setInterval(function(){
        $('#showtest').load('result-auto-current.php');
         },1000);

    </script>

     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['vStatus', 'Numbers'],
        <?php 
            while($row = mysqli_fetch_array($result)){
              echo"['".$row['vStatus']."',".$row['number']."],";
              }
             ?>
        ]);

        var options = {
          title: 'SSC Voting for Tertiary Percentage:',
          is3D:true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

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

                                <li class="nav-item ">
                                        <a href="addvoters.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Voters</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="addschoolyear.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Schoolyear</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="addparty.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Partylist</a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="addposition.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Position</a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="addcandidates.php" class="nav-link"><i class='fas fa-plus-circle' style='font-size:13px;color:#015baa;margin: 4px'></i>Candidates</a>
                                    </li>
     
                             
                        
                                    <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fas fa-poll-h' style='font-size:13px;color:#015baa;margin: 4px'></i>
                                      Current Results
                                   </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                       <a class="dropdown-item" href="viewresults-current.php">Tertiary</a>
                                       <a class="dropdown-item" href="shs.viewresults-current.php">Senior High</a>
                                       
                                     </div>                             
                                  </li>


                                    <li class="nav-item">
                                        <a href="includes/logout.php" class="nav-link"><i class="fas fa-sign-out-alt" style='font-size:13px;color:#015baa;margin: 4px'></i>Logout</a>
                                    </li>
                            
                            </ul>
                        </div>
                    
                </nav>


<br><br><br><br><br><br>




<div class="container">
    <div class="row">
        <div class="col-md-3" style="padding-top: 35px;">
            
            <h3>Select School Year</h3>
             <hr style="background: #ffc107;height: 2px;">
            
                <div class="form-group">
                    <label for="schoolyear">School Year</label>
                    <select name="schoolyear" class="form-control" id="cur-syList">
                     
               <?php
       foreach($results as $output)
                                    {  

                                        if($output["schoolyear"] == ''){?>
                <option >No active schooolyear</option>

               <?php }else {?>
                                <option ><?php echo $output["schoolyear"]; ?></option>
                            <?php }} ?>
                            
                    </select>
                </div>
           <div id="piechart" style="text-align: left; width: 450px; height: 300px; padding-bottom: 40px;margin-left: -70px; padding-right: 50px;"></div>
        </div>

                    

        <div class="col-md-9" id="showtest" >
                <?php include('result-auto-current.php'); ?>

        </div> 
    </div>
</div>

<!-- <script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">  
        $(document).ready(function() {

            setInterval(function() {
                $('#refresh').load('data.php')
            }, 1000);
        });

</script> -->
       <br><br><br>

<div class="footer" style="position: fixed; left: 0;bottom: 0; width: 100%; text-align:right;color: #054b88; justify-content: left; font-size: 11px">
    <div class="">
<p>
            Copyright 2021 @
            STI College Tanauan SSC-Voting System

   </p>
</div>
</div>


<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 



</body>
</html>





<?php } else {header('location: index.php');} ?>





