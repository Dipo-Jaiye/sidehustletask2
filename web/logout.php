<?php
//undo login status by removing session id
session_start();
$_SESSION["id"] = "";

//redirect to home page
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
header("refresh:1,url=http://$host$uri/$extra");
?>