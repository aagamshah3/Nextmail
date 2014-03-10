<?php
session_start();
$_SESSION['username'] = "";
$_SESSION['password']= "";
unset($_SESSION['username']);
unset($_SESSION['password']);
session_destroy();
header("Location: index.php");
?>