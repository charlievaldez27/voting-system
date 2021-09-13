


<?php
     include("admin/class/Result.php");
    require("admin/includes/db.php");

        

    $readResults = new Result();
    $rtnReadYear = $readResults->READ_YEAR();



    // $countVotes = new Result();
    // $rtnCountVotes = $countVotes->COUNT_VOTES($rowCountVotes['id']);
 
    //Params 
    // $schoolyear = "2019-2020";
    if(empty($_COOKIE['ResultYear'])){
        echo "Loading active schoolyear...";
    }else{
    $schoolyear = $_COOKIE['ResultYear'];
     $readResults = new Result();
    $rtnReadPos = $readResults->READ_POS_BY_YEAR($schoolyear);
    ?>

    <!--  <a href="print.php?schoolyear=<?php echo $schoolyear; ?>"><h3><span class="fas fa-print " style="float: right"></h3></span>  </a> -->
                <h4 style="text-align: center;"><?php echo $schoolyear; ?> SSC Voting election candidate profile</h4><div id="refresh"><p style="text-align: center;">as of <?php date_default_timezone_set('Asia/Manila'); echo date('F j, Y '); ?>  </p></div>   

                <hr style="background: #ffc107;height: 2px;">
     

            <?php while($rowPos = $rtnReadPos->fetch_assoc()) { ?>
    

                    <h5><?php echo "<p style = 'color: #025baa;'>".$rowPos['position']."</p>"; ?></h5>

                        <?php
                        $ReadYearPos = new Result();
                        $rtnReadYearPos = $ReadYearPos->READ_NOM_BY_YEAR_POS($schoolyear, $rowPos['position']);

                        ?>
                        <div class="table-responsive">
                            <?php if($rtnReadYearPos) { ?>
                           
                                <?php while($rowCountVotes = $rtnReadYearPos->fetch_assoc()) { ?>
                                    



                                    <?php
                                    $countVotes = new Result();
                                    $rtnCountVotes = $countVotes->COUNT_VOTES($rowCountVotes['id']);
                                        // $win=$rtnCountVotes->num_rows;
                                    ?><hr style="background: #ffc107;">
                                    <p style="width: 240px; font-weight: 600;"><?php echo $rowCountVotes['Firstname']." ".$rowCountVotes['MI']." ".$rowCountVotes['Lastname']; ?></p>
                                    <p style="width:350px;"><?php echo $rowCountVotes['partylist']; ?></p>
                                    <p style="width: 280px;"><?php echo $rowCountVotes['Cprofile']; ?></p>


                                <?php } //End while ?>
                           
                            <?php $rtnReadYearPos->free(); } //End if ?><hr style="background: #ffc107; height: 2px">
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

