<?php
session_start();
unset($_SESSION['PartylistID']);
header('location: index.php');
exit
?>