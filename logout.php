<?php
session_start();
session_unset();
session_destroy();

$_SESSION['danger'] = "Logout Successful";
header("Location:login.php");
?>