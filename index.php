<?php 
session_start();
if(!isset($_SESSION['login'])) {
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GoParking</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Navabar -->
    <section id="navbar">
      <nav class="navbar navbar-expand-lg navbar-dark shadow-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="#navbar">GoParking</a>
          <button class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php"
                  >Home</a
                >
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="input" role="button" data-bs-toggle="dropdown">
                  Input
                </a>
                <ul class="dropdown-menu" aria-labelledby="input">
                  <li><a class="dropdown-item" href="lokasi.php">Lokasi</a></li>
                  <li><a class="dropdown-item" href="kendaraan.php">Kendaraan</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="output.php">Output</a>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </section>
    <!-- Akhir Navbar -->

    <!-- Home -->
    <section class="bg-light">
      <div class="container">
        <div class="pt-5">
          <?php if (isset($_SESSION['success'])) { ?>
          <div class="alert alert-success"><?php echo $_SESSION['success'] ?></div>
          <?php unset($_SESSION['success']);  } ?>
        </div>
        <div class="row">
          <div class="py-5 col-md">
            <h1 class="mb-3">
              Atur keluar, masuk kendaraan dengan GoParking
            </h1>
            <h5 class="text-muted mb-3">
              GoParking merupakan sebuah sistem yang
              dibangun sebagai solusi dalam pengelolaan
              parkir yang tertata dan sistematis,
              sehingga memudahkan petugas parkir dalam
              memantau kendaraan yang terparkir di suatu
              lokasi tertentu.
            </h5>
            <div class="d-flex flex-column flex-md-row">
              <a
                href="kendaraan.php"
                class="btn btn-primary text-light p-3 fw-bolder me-md-3 mb-3"
              >
                Masukkan data
              </a>
              <a href="output.php" class="btn btn-outline-secondary p-3 fw-bolder mb-3">
                Tampilkan data
              </a>
            </div>  
          </div>
          <div class="py-5 col-md container">
            <img
              src="img/illustrasi-parkir2.png"
              alt="Illustrasi Parkir 2"
              class="img-fluid"
              width="600"
            />
          </div>
        </div>
      </div>
    </section>
    <!-- Akhir Home -->

    <!-- Footer -->
    <section class="bg-secondary py-3">
      <div class="container text-light text-center">
        Copyright © 2022 Fery Anuar | 2010631250046
      </div>
    </section>
    <!-- Akhir Footer -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>