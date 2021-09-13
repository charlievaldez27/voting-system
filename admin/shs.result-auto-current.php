
<?php
     include("class/SHSCurrentResult.php");
          include("class/Year.php");
    include("includes/db.php");

        

    // $readResults = new Year();
    // $rtnReadYear = $readResults->READ_YEAR();



    // $countVotes = new Result();
    // $rtnCountVotes = $countVotes->COUNT_VOTES($rowCountVotes['id']);
 
    //Params 
    // $schoolyear = "2019-2020";
    if(empty($_COOKIE['cur-sy'])){
        echo "Loading active schoolyear...";
    }else{
    $schoolyear = $_COOKIE['cur-sy'];
     $readResults = new Result();
    $rtnReadPos = $readResults->READ_POS_BY_YEAR($schoolyear);
    ?>


     <a href="print.php?schoolyear=<?php echo $schoolyear; ?>"><h3><span class="fas fa-print " style="float: right"></h3></span></a>
      <?php
      if($schoolyear == 'null'):
        ?>
        <?php echo "Set a schoool year into Running and start an election first to view results.";?>
        <?php else: ?>
           
                <h4> SSC Voting Result for Senior High (<?php echo $schoolyear; ?>)</h4><div id="refresh"><p>as of <?php date_default_timezone_set('Asia/Manila'); echo date('F j, Y g:i:sa');    ?>  </p></div>   

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
                                        // $win=$rtnCountVotes->num_rows;
                                    ?>
                                    <table style="text-align: center; font-family: century gothic; font-size: 17px">

                                    <tr>

                                        <!-- <td style="width: 15%;"><?php echo $rowCountVotes['id']; ?></td> -->
                                         <td style="width:350px;"><?php echo $rowCountVotes['partylist']; ?></td>
                                        <td style="width: 240px;"><?php echo $rowCountVotes['Firstname']." ".$rowCountVotes['MI']." ".$rowCountVotes['Lastname']; ?></td>
                                        <td style="width: 280px;"><?php echo $rtnCountVotes->num_rows; ?></td> 
<!--                                          <?php  
                                        $rtnCountVotes->num_rows;
                                            $len = 0;
                                            foreach ($rtnCountVotes->num_rows as $arr) {
                                                      $len = $len + 1;  # code...
                                            }

                                            $max = $rtnCountVotes->num_rows[0];
                                            for($i = 1; $i < $len;  $i++) {
                                                if($rtnCountVotes->num_rows[$i] > $max){
                                                    $max = $rtnCountVotes->num_rows[$i];
                                                }
                                                # code...
                                            }

                                         ?>
                                         <td style="width: 280px;"><?php echo $rtnCountVotes->num_rows; ?></td> -->

                                         <?php

                                         ?>
                                    </tr>
                            <?php
                            $id = $rowCountVotes['id'];
                             $position = $rowPos['position'];
                             $partylist = $rowCountVotes['partylist'];
                             $fullname = $rowCountVotes['Firstname']." ".$rowCountVotes['MI']." ".$rowCountVotes['Lastname'];
                             $votes =  $rtnCountVotes->num_rows;
                             // $mysqli->query("UPDATE tbl_winners set position = '$position',partylist = '$partylist',fullanme ='$fullname',votes = '$votes' where id='$id'") or die ($mysqli->error());

                            $count = count($rowCountVotes['id']);
                            for($i = 0; $i < $count; $i++){
                        
                                // $sql = "INSERT INTO votes(schoolyear, position, candidate_id, voters_id, fullname)VALUES('{$schoolyear
                                //  [$i]}', '{$position[$i]}', '{$candidate_id[$i]}', '{$voters_id[$i]}', '{$fullname[$i]}');"; 
                                $sql = "UPDATE tbl_winners set id = '{$rowCountVotes['id']}' position = '{$rowPos['position']}',partylist = '{$rowCountVotes['partylist']}',fullanme ='{$rowCountVotes['Firstname']}',votes = '{$votes}' ";

                                 $db->query($sql);




                    
                     }
                            ?>





                                <?php } //End while ?>
                            </table>
                            <?php $rtnReadYearPos->free(); } //End if ?><hr style="background: #ffc107">
                        </div>
                             <?php } //End while ?>
                         <?php } ?>


  <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    var currentSY = $('#cur-syList').val();

    // window.location.href = "maintest.php?sy="+currentSY+"";
    $(document).ready(function(){

        createCookie("cur-sy",currentSY);

    });
    function createCookie(name,value){
        document.cookie = escape(name) + "="+ escape(value);
    }

</script>

