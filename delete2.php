<?php
include 'config.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "DELETE FROM kendaraan WHERE id='$id'");
header("Location: kendaraan.php");
?>