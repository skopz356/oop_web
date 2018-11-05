<?php 
session_start();
$_SESSION["login"] = FALSE;
$domain = $_SERVER['REQUEST_URI'];
header("Location: http://$_SERVER[HTTP_HOST]")
?>