<?php
     include("class/SHSResult.php");
          include("class/SHSYear.php");
    include("includes/db.php");

            // if(isset($_POST['save'])) {
            //     $schoolyear = $_POST['schoolyear'];
            //     $position = $_POST['position'];
            //     $candidate_id = $_POST['candidate_id'];
            //     $partylist = $_POST['partylist'];
            //     $fullname = $_POST['fullname'];
            //     $votes = $_POST['votes'];
             
        


            //     $count = count($_POST['candidate_id']);
            //     for($i = 0; $i < $count; $i++){
                        
            //          $sql = "UPDATE tbl_winners set candidate_id = '{$candidate_id[$i]}', schoolyear = '{$schoolyear[$i]}', position = '{$position[$i]}', partylist = '{$partylist[$i]}', fullname = '{$fullname[$i]}', votes = '{$votes[$i]}'"; 

            //     // $sql = "UPDATE votes set fullname = 'fullname + 1' ,schoolyear = '{$schoolyear[$i]}', position = '{$position[$i]}', candidate_id = '{$candidate_id[$i]}', voters_id = '{$voters_id[$i]}' where schoolyear = '{$schoolyear[$i]}', position = '{$position[$i]}', candidate_id = '{$candidate_id[$i]}', voters_id = '{$voters_id[$i]}' ";

            //          $db->query($sql);




                    
            //          }
           
            //          if($i == $count){
                         


            //             $_SESSION['message'] = "Record saved!";
            //             $_SESSION['msg_type'] = "success";
            //             header('location: shs.viewresults.php');
                         
            //             }
                    
            // }
          

            

        

    // $readResults = new SHSYear();
    // $rtnReadYear = $readResults->READ_YEAR();



    // $countVotes = new Result();
    // $rtnCountVotes = $countVotes->COUNT_VOTES($rowCountVotes['id']);
 
    //Params 
    // $schoolyear = "2019-2020";
    if(empty($_COOKIE['sy'])){
        echo "Loading active schoolyear...";
    }else{
    $schoolyear = $_COOKIE['sy'];
     $readResults = new Result();
    $rtnReadPos = $readResults->READ_POS_BY_YEAR($schoolyear);
    ?>


     <a href="print.php?schoolyear=<?php echo $schoolyear; ?>"><h3><span class="fas fa-print " style="float: right"></h3></span></a>

      <?php
      if($schoolyear == 'null'):
        ?>
        <?php echo "Set a schoool year into active and start an election first to view results.";?>
        <?php else: ?>
           
                <h4 style="font-size: 28px;">SSC Voting Result for Senior High (<?php echo $schoolyear; ?>)</h4><div id="refresh"><!-- <p>as of <?php date_default_timezone_set('Asia/Manila'); echo date('F j, Y g:i:sa');    ?>  </p> --></div>   

        <?php endif; ?>

                <hr style="background: #ffc107;height: 2px;">
     

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
                                     
                                    ?>
                                    <table >

                                    <tr>

                                            <!--  <td style="width: 15%;"><?php echo $rowCountVotes['id']; ?></td>  -->
                                         <td style="width:350px;"><?php echo $rowCountVotes['partylist']; ?></td>
                                        <td style="width: 240px;"><?php echo $rowCountVotes['Firstname']." ".$rowCountVotes['MI']." ".$rowCountVotes['Lastname']; ?></td>
                                        <td style="width: 280px;"><?php echo $rtnCountVotes->num_rows; ?></td>

                                    </tr>




                                     </table>
                                    <!--  <form action="" method="POST" role="form">
                        <input type="hidden" name="schoolyear[]" value="<?php echo $schoolyear; ?>">
                        <input type="hidden" name="position[]" value="<?php echo $rowPos['position']; ?>">
                        <input type="hidden" name="candidate_id[]" value="<?php echo $rowCountVotes['id']; ?>">
                        <input type="hidden" name="partylist[]" value="<?php echo $rowCountVotes['partylist']; ?>"> 
                        <input type="hidden" name="fullname[]" value="<?php echo $rowCountVotes['Firstname']; ?>"> 
                        <input type="hidden" name="votes[]" value="<?php echo $rtnCountVotes->num_rows; ?>">
                             <button type="submit" name="save" class="btn btn-primary" style="float: right;">save</button>
                         </form> -->
                                <?php } //End while ?>
                           
                            <?php $rtnReadYearPos->free(); } //End if ?><hr style="background: #ffc107">
                        </div>
                             <?php } //End while ?>
                         <?php } ?>


  <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    var currentSY = $('#syList').val();

    // window.location.href = "maintest.php?sy="+currentSY+"";
    $(document).ready(function(){

        createCookie("sy",currentSY);

    });
    function createCookie(name,value){
        document.cookie = escape(name) + "="+ escape(value);
    }

</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

        if(isset($_SESSION['message'])){
?>

        <script>
            swal({ title: "<?php echo $_SESSION['message']; ?>",
            text:  "Thank you!",
            type: "<?php echo $_SESSION['msg_type']; ?>"}).then(okay => {
       if (okay) {
            window.location.href = "shs.viewresults.php";
                    }
            });
        </script>
                     
        <?php
            // echo $_SESSION['message'];
             unset($_SESSION['message']);
            }
         ?>

<!--SELECT tbl_position.Level, tbl_position.position, tbl_nominees.partylist, tbl_nominees.Firstname, count(votes.candidate_id) as votes FROM `tbl_position` INNER JOIN tbl_nominees on tbl_nominees.position = tbl_position.position INNER JOIN votes on tbl_nominees.id = votes.candidate_id where tbl_nominees.Level = 'Senior High' and tbl_position.Level = 'Senior High' group BY votes.candidate_id, votes.position order by votes.candidate_id, count(votes.candidate_id) desc -->