<?php 
include 'config.php';
session_start();
if(!isset($_SESSION['login'])) {
  header("Location: login.php");
} else {
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
                <a class="nav-link dropdown-toggle" href="#" id="input" role="button" data-bs-toggle="dropdown">
                  Input
                </a>
                <ul class="dropdown-menu" aria-labelledby="input">
                  <li><a class="dropdown-item" href="lokasi.php">Lokasi</a></li>
                  <li><a class="dropdown-item" href="kendaraan.php">Kendaraan</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="output.php">Output</a>
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

    <!-- Lihat Data -->
    <section class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md p-5">
            <h3 class="fw-bolder mb-3">Lokasi</h3>
            <form action="output.php" method="post">
                <div class="mb-3 d-inline-flex">
                    <select class="form-select" name="lokasi" id="lokasi">
                        <option selected>- Pilih lokasi -</option>
                        <?php
                        $sql = "SELECT * FROM lokasi";
                        $result =  mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)) {     
                        ?>
                        <option value="<?php echo $row['nama'] ?>"><?php echo $row['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
              <div>
                <button type="submit" class="btn btn-primary" name="output">Tampilkan</button>
              </div>
            </form>
          </div>
          <div class="col-md p-5">
            <h3 class="fw-bolder mb-3 text-center">Daftar kendaraan</h3>
            <table class="table table-responsive table-light">
              <thead>
                <tr class="text-center">
                  <th>Plat nomor</th>
                  <th>Jenis kendaraan</th>
                  <th>Durasi</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              date_default_timezone_set('Asia/Jakarta');
              if(isset($_POST['output'])) {
                $lokasi = $_POST['lokasi'];

                $sql = "SELECT * FROM kendaraan WHERE lokasi='$lokasi'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
                $awal = date_create($row['waktu']);
                $akhir = date_create();
                $diff = date_diff($awal, $akhir);
                echo"<tr class='align-middle'>
                  <td>".$row['plat']."</td>
                  <td>".$row['jenis']."</td>
                  <td>$diff->h Jam</td>
                  <td class='text-center'><a class='btn btn-success' href='print.php?id=$row[id]'>Cetak</a></td>
                </tr>";
                }
              } else {
                  echo"";
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <!-- Akhir Lihat Data -->

    <!-- Footer -->
    <section class="bg-secondary py-4">
      <div class="container text-light text-center">
        Copyright © 2022 Fery Anuar | 2010631250046
      </div>
    </section>
    <!-- Akhir Footer -->

    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<?php 
}
?>