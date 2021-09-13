<?php

include 'includes/connect.php';

if(isset($_POST["action"])){
$output1 = '';

if($_POST["action"] == "level"){
	$query = "SELECT PartylistName from tbl_partylist where status = 'Active' and Level = '".$_POST["query"]."' group by PartylistName";
	$result = mysqli_query($mysqli, $query);
	$output1 .= '<option>Choose Partylist</option>';
	while($row = mysqli_fetch_array($result)){
		$output1 .= '<option>'.$row['PartylistName'].'</option>';
	}
}

echo $output1;

}
?>