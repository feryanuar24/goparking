<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GoParking</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <!-- Kiri -->
    <section class="float-start bg-light p-5">
      <div class="container">
        <div><h2>GoParking</h2></div>
        <div class="mb-3">
          <p class="text-muted">
            Sebuah website yang dirancang untuk mempermudah <br />
            petugas parkir mencatat keluar masuk kendaraaan.
          </p>
        </div>
        <div class="pt-3">
          <img
            src="img/illustrasi-parkir.png"
            alt="Ilustrasi Konsep Parkir"
            width="500"
            class="img-fluid"
          />
        </div>
      </div>
    </section>
    <!-- Akhir Kiri -->

    <!-- Kanan -->
    <section class="bg-white float-start p-5">
      <div class="container">
        <div class="text-muted">MULAI GRATIS</div>
        <div>
          <h1>Mendaftar ke GoParking</h1>
        </div>
        <div class="text-muted mb-5">
          Sudah menjadi anggota?
          <a href="login.php" class="text-decoration-none">Masuk</a>
        </div>
        <?php session_start(); 
        if(isset($_SESSION['danger'])) { ?>
        <div class="alert alert-danger"><?php echo $_SESSION['danger'] ?></div>
        <?php unset($_SESSION['danger']); } ?>
        <div>
          <form action="register_success.php" method="post">
          <div class="form-label">
              <label for="nama">Nama Lengkap</label>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
              </svg>
              </span>
              <input
                type="text"
                name="nama"
                id="nama"
                placeholder="Fery Anuar"
                class="form-control"
              />
            </div>
            <div class="form-label">
              <label for="email">E-mail</label>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">@</span>
              <input
                type="email"
                name="email"
                id="email"
                placeholder="admin@gmail.com"
                class="form-control"
              />
            </div>
            <div class="form-label">
              <label for="password">Password</label>
            </div>
            <div class="input-group mb-4">
              <span class="input-group-text">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-lock"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"
                  />
                </svg>
              </span>
              <input
                type="password"
                name="password"
                id="password"
                placeholder="admin"
                class="form-control"
              />
            </div>
            <div>
              <button type="submit" name="register" class="btn btn-primary col-12">
                Buat akun
              </button>
            </div>
          </form>
        </div>      
        <div class="text-muted pt-8">
          Copyright © 2022 Fery Anuar | 2010631250046
        </div>
      </div>

    </section>
    <!-- Akhir Kanan -->

    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
