<?php 
include 'config.php';

session_start();

if(!isset($_SESSION['login'])) {
  header("Location: login.php");
} else {
  if(isset($_POST['perbarui'])){	
    $id = $_POST['id'];
    $plat = $_POST['plat'];
    $jenis = $_POST['jenis'];
    $waktu = $_POST['waktu'];
    $lokasi = $_POST['lokasi'];
    $result = mysqli_query($conn, "UPDATE kendaraan SET plat='$plat',jenis='$jenis',waktu='$waktu',lokasi='$lokasi' WHERE id='$id'");
    header("Location: kendaraan.php");
  }
  
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM kendaraan WHERE id='$id'"); 
while($row = mysqli_fetch_array($result)){
	$plat = $row['plat'];
	$jenis = $row['jenis'];
  $waktu = $row['waktu'];
	$lokasi = $row['lokasi'];
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

    <!-- Update Kendaraan -->
    <section class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-8 p-5">
              <img class="img-fluid" src="img/illustrasi-parkir3.png" alt="Illustrasi Parkir 3" width="730">
          </div>
          <div class="col-md-4 p-5">
              <h3 class="mb-3 fw-bolder">Perbarui kendaraan</h3>
              <form action="update2.php" method="post">
                <div>
                  <label class="form-label" for="plat">Plat nomor</label>
                </div>
                <div class="mb-3">
                  <input class="form-control" type="text" name="plat" id="plat" value="<?php echo $plat;?>">
                </div>
                <div>
                  <label class="form-label" for="jenis">Jenis kendaraan</label>
                </div>
                <div class="mb-3">
                  <input class="form-control" type="text" name="jenis" id="jenis" value="<?php echo $jenis;?>">
                </div>
                <div>
                  <label class="form-label" for="waktu">Waktu</label>
                </div>
                <div class="mb-3">
                  <input class="form-control" type="time" name="waktu" id="waktu" value="<?php echo $waktu;?>">
                </div>
                <div>
                  <label class="form-label" for="lokasi">Lokasi</label>
                </div>
                <div class="mb-3">
                  <select class="form-select" name="lokasi" id="lokasi">
                      <?php
                      $sql = "SELECT * FROM lokasi";
                      $result = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_array($result)) {     
                      ?>
                      <option value="<?php echo $row['nama'] ?>"><?php echo $row['nama'] ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div>
                  <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                  <input type="submit" class="btn btn-primary" name="perbarui" value="Perbarui">
                </div>
              </form>
          </div>
        </div>
      </div>
    </section>
    <!-- Akhir Update Kendaraan -->

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

<?php } ?>
