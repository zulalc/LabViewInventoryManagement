<?php
session_start();
unset($_SESSION['authenticated']); //unset a session
unset($_SESSION['authUser']); 
unset($_SESSION["role"]); 

$_SESSION['status'] = "You are Logged out Succesfully";
header("Location: login.php");
?>