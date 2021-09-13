
<?php
     include("classes/SHSResult.php");
          include("classes/Year.php");
    require("admin/includes/db.php");

        

    $readResults = new Year();
    $rtnReadYear = $readResults->READ_YEAR();



    // $countVotes = new Result();
    // $rtnCountVotes = $countVotes->COUNT_VOTES($rowCountVotes['id']); 
 
    //Params 
    // $schoolyear = "2019-2020";
    if(empty($_COOKIE['ResultYear'])){
        echo "Loading active schoolyear...";
    }else{
    $schoolyear = $_COOKIE['ResultYear'];
     $readResults = new SHS_Result();
    $rtnReadPos = $readResults->READ_POS_BY_YEAR($schoolyear);
    ?>

            <h4 style="text-align: center;"> SSC Voting Result for Senior High <br> School Year: <?php echo $schoolyear; ?></h4><div id="refresh"><p style="text-align: center;">as of <?php date_default_timezone_set('Asia/Manila'); echo date('F j, Y g:i:sa'); ?>  </p></div> 
          
    <!--  <a href="print.php?schoolyear=<?php echo $schoolyear; ?>"><h3><span class="fas fa-print " style="float: right"></h3></span>  </a> -->
  

                <hr style="background: #ffc107;height: 2px;">
     

            <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>  
    

                    <h5><?php echo $rowPos['position']; ?></h5>

                        <?php
                        $ReadYearPos = new SHS_Result();
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
                                    $countVotes = new SHS_Result();
                                    $rtnCountVotes = $countVotes->COUNT_VOTES($rowCountVotes['id']);
                                        // $win=$rtnCountVotes->num_rows;
                                    ?>
                                    <table style="text-align: center; font-family: century gothic; font-size: 17px">

                                    <tr>

                                        <!-- <td style="width: 15%;"><?php echo $rowCountVotes['id']; ?></td> -->
                                         <td style="width:350px;"><?php echo $rowCountVotes['partylist']; ?></td>
                                        <td style="width: 240px;"><?php echo $rowCountVotes['Firstname']." ".$rowCountVotes['MI']." ".$rowCountVotes['Lastname']; ?></td>
                                        <td style="width: 280px;"><?php echo $rtnCountVotes->num_rows; ?></td>

                                    </tr>



                                   

                                <?php } //End while ?>
                            </table>
                            <?php $rtnReadYearPos->free(); } //End if ?><hr style="background: #ffc107">
                        </div>
                             <?php } //End while ?>
                         <?php } ?>


  <script type="text/javascript" src="admin/js/jquery.js"></script>
<script type="text/javascript">
    var currentYear = $('#getyear').val();

    // window.location.href = "maintest.php?sy="+currentSY+"";
    $(document).ready(function(){

        createCookie("ResultYear",currentYear);

    });
    function createCookie(name,value){
        document.cookie = escape(name) + "="+ escape(value);
    }

</script>

