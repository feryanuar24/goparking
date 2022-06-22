<?php
include 'config.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "DELETE FROM lokasi WHERE id='$id'");
header("Location: lokasi.php");
?>