<?php

include 'includes/connect.php';
$schoolyear = $_COOKIE['sy'];
if(isset($_POST["action"])){
$output1 = '';

if($_POST["action"] == "level"){
	$query = "SELECT position from tbl_position where status = 'Active' and schoolyear = '$schoolyear' and Level = '".$_POST["query"]."' group by position";
	$result = mysqli_query($mysqli, $query);
	$output1 .= '<option>Choose Position</option>';
	while($row = mysqli_fetch_array($result)){
		$output1 .= '<option>'.$row['position'].'</option>';
	}
}

echo $output1;

}
?>
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