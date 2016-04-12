<?php session_start();
$_SESSION['test']='TEST SESSION TEXT';
header('location:sessrecieve.php');
?>
