<?php
session_start();
if(isset($_POST['register'])) {
    include 'config.php';

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = sha1($password);

    $sql = "SELECT email FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if($email == $row['email']) {
        $_SESSION['danger'] = "E-mail telah digunakan";
        header("Location: register.php");
    } else {
        $sql2 = "INSERT INTO user VALUES (null,'$nama','$email','$password')";
        $result2 = mysqli_query($conn, $sql2);
        $_SESSION['nama'] = $nama;
        $_SESSION['success'] = "Selamat "
        .$_SESSION['nama'].
        " pendaftaran anda berhasil.";
        header("Location: login.php");
    }

}