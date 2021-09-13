<!-- <?php
session_start();
require_once('includes/conn.php');
$mysqli->query("UPDATE tbl_addvoters set Availability = 'Offline' where uid = '".$_SESSION['ID']."'") or die ($mysqli->error());
$mysqli->close();

unset($_SESSION['ID']);
unset($_SESSION['GetUser']);

header('location: index.php');
exit();
?>
 -->
<?php

require_once('includes/conn.php');

if(isset($_SESSION['email'])){
   // Delete token 
   $myusername = mysqli_real_escape_string($con,$_SESSION['email']);
   
   mysqli_query($con, "delete from user_token where username = '".$myusername."'");
   
   // Destroy session
unset($_SESSION['ID']);
unset($_SESSION['GetUser']);
   header('Location: index.php');
}else{
	unset($_SESSION['ID']);
unset($_SESSION['GetUser']);
   header('Location: index.php');
}