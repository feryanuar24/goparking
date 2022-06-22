<?php
session_start();
if(isset($_POST['login'])) {
    include 'config.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = sha1($password);

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) > 0) {
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['success'] = "Selamat datang ".$_SESSION['nama']." di halaman dasbor.";
        $_SESSION['login'] = true;
        header("Location: index.php");
    } else {
        $_SESSION['danger'] = "Login gagal, password salah.";
        header("Location: login.php");
    }
}
?>
