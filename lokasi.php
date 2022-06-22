<?php 
include 'config.php';

session_start();

if(!isset($_SESSION['login'])) {
  header("Location: login.php");
} else {
  if(isset($_POST['lokasi'])) {

  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $waktu = $_POST['waktu'];

  $sql = "INSERT INTO lokasi VALUES (null,'$nama','$alamat','$waktu')";
  $result = mysqli_query($conn, $sql);
  } else {
    echo"";
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
                <a class="nav-link" aria-current="page" href="index.php"
                  >Home</a
                >
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="input" role="button" data-bs-toggle="dropdown">
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

    <!-- Lokasi -->
    <section class="bg-light">
      <div class="container">
        <div class="row">
          <div class="p-5 col-md-4">
            <h3 class="fw-bolder mb-3">Lokasi</h3>
            <form action="lokasi.php" method="post">
              <div>
                <label class="form-label" for="nama">Nama Tempat</label>
              </div>
              <div class="mb-3">
                <input class="form-control" type="text" name="nama" id="nama">
              </div>
              <div>
                <label class="form-label" for="alamat">Alamat</label>
              </div>
              <div class="mb-3">
                <input class="form-control" type="text" name="alamat" id="alamat">
              </div>
              <div>
                <label class="form-label" for="waktu">Jam Operasional</label>
              </div>
              <div class="mb-3">
                <input class="form-control" type="text" name="waktu" id="waktu">
              </div>
              <div>
                <button type="submit" class="btn btn-primary" name="lokasi">Buat</button>
              </div>
            </form>
          </div>
          <div class="p-5 col-md-8">
            <h3 class="fw-bolder mb-3 text-center">Daftar lokasi</h3>
            <table class="table table-light table-responsive">
              <thead>
                <tr class="text-center">
                  <th>Nama Tempat</td>
                  <th>Alamat</td>
                  <th>Jam Oprasional</td>
                  <th>Opsi</td>
                </tr>
              </thead>
              <tbody class="align-middle">
                <?php 
                $sql = "SELECT * FROM lokasi ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_array($result)){
                  echo"<tr>
                    <td>".$row['nama']."</td>
                    <td>".$row['alamat']."</td>
                    <td>".$row['waktu']."</td>
                    <td>
                      <div class='d-flex flex-column flex-md-row'>
                        <a href='update.php?id=$row[id]' class='btn btn-warning me-md-3 my-1'>Perbarui</a>
                        <a href='delete.php?id=$row[id]' class='btn btn-danger my-1'>Hapus</a>
                      </div>
                    </td>
                  </tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- Akhir Lokasi -->

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

<?php } ?>