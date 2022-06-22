<?php 
include 'config.php';

session_start();

if(!isset($_SESSION['login'])) {
  header("Location: login.php");
} else {
  if(isset($_POST['perbarui'])){	
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $waktu = $_POST['waktu'];
    $result = mysqli_query($conn, "UPDATE lokasi SET nama='$nama',alamat='$alamat',waktu='$waktu' WHERE id='$id'");
    header("Location: lokasi.php");
  }
  
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM lokasi WHERE id='$id'"); 
while($row = mysqli_fetch_array($result)){
	$nama = $row['nama'];
	$alamat = $row['alamat'];
	$waktu = $row['waktu'];
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

    <!-- Update Lokasi -->
    <section class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-8 p-5">
              <img class="img-fluid" src="img/illustrasi-parkir3.png" alt="Illustrasi Parkir 3" width="750">
          </div>
          <div class="col-md-4 p-5">
              <h3 class="mb-3 fw-bolder">Perbarui lokasi</h3>
              <form action="update.php" method="post">
                <div>
                  <label class="form-label" for="nama">Nama Tempat</label>
                </div>
                <div class="mb-3">
                  <input class="form-control" type="text" name="nama" id="nama" value="<?php echo $nama;?>">
                </div>
                <div>
                  <label class="form-label" for="alamat">Alamat</label>
                </div>
                <div class="mb-3">
                  <input class="form-control" type="text" name="alamat" id="alamat" value="<?php echo $alamat;?>">
                </div>
                <div>
                  <label class="form-label" for="waktu">Jam Operasional</label>
                </div>
                <div class="mb-3">
                  <input class="form-control" type="text" name="waktu" id="waktu" value="<?php echo $waktu;?>">
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
    <!-- Akhir Update Lokasi -->

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
