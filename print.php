<?php 
include 'config.php';
session_start();
if(!isset($_SESSION['login'])) {
  header("Location: login.php");
} else {
?>

<html>
    <head>
        <title>GoParking</title>
    </head>
    <body style='font-family:tahoma; font-size:8pt;' onload="javascript:window.print()">
            <?php 
            include 'config.php';

            date_default_timezone_set('Asia/Jakarta');

            $sql = "SELECT * FROM lokasi";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            $sql2 = "SELECT * FROM kendaraan";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($result2);

            $sql3 = "SELECT * FROM user";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_array($result3);

            $awal = date_create($row2['waktu']);
            $akhir = date_create();
            $diff = date_diff($awal, $akhir);
            
            $kendaraan = $row2['jenis'];
            if($kendaraan = "motor") {
                $harga = 2000;
            } else if($kendaraan = "mobil") {
                $harga = 5000;      
            } else {
                $harga = 10000;
            };
            $total = ($diff->h + 1) * $harga;

            echo "TIKET PARKIR";
            echo "<br>";  
            echo $row['nama']." - ".$row['alamat'];
            echo "<br>";
            echo "=========================";
            echo "<br>";
            echo "No: ".$row2['id']."/".$row2['jenis'];
            echo "<br>";
            echo "Plat: ".$row2['plat'];
            echo "<br>";
            echo "Masuk: ".$row2['waktu'];
            echo "<br>";
            echo "Keluar: ".date("H:i");
            echo "<br>";
            echo "Durasi: ".$diff->h." Jam";
            echo "<br>";
            echo "ID: ".$row3['id'];
            echo "<br>";
            echo "Petugas: ".$row3['nama'];
            echo "<br>";
            echo "Total: Rp ".$total;
            echo "<br>";
            echo "=========================";
            echo "<br>";
            echo "Terima Kasih - Selamat Jalan"
            ?>
    </body>
</html>

<?php } ?>