<?php
define("HOST_NAME", "localhost");
define("HOST_USER", "root");
define("HOST_PASS", "");
define("HOST_DB", "db_ssc_voting");
$db = new mysqli(HOST_NAME, HOST_USER, HOST_PASS, HOST_DB);
$mysqli = mysqli_connect(HOST_NAME, HOST_USER, HOST_PASS, HOST_DB);	
?>
		
