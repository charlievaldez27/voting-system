<?php
session_start();
unset($_SESSION['USER_ID']);
header('location: ../index.php');
exit
?>