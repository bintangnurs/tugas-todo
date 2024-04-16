<?php 
session_start();

if (!isset($_SESSION['pegawai'])) {
   echo "<script>
         window.location.replace('session/login.php');
       </script>";
  exit;
}

require '../functions.php';


if (isset($_POST["hadir"])) {
  
  if (add_kehadiran($_POST) > 0 ) {
     echo "<script>
        alert('Berhasil Absen Hadir!');
        window.location.href='pegawai.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 

if (isset($_POST["izin"])) {
  
  if (add_perizinan($_POST) > 0 ) {
     echo "<script>
        alert('Berhasil Absen Izin!');
        window.location.href='pegawai.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 

$perizinan = mysqli_query($conn, 'SELECT * FROM perizinan ORDER BY id DESC');


$keyword = $_GET["keyword"];

$query = "SELECT * FROM perizinan
      WHERE
      tanggal_mulai LIKE '%$keyword%' OR
      tanggal_akhir LIKE '%$keyword%' 
        ";
$perizinan = query($query);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../link.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body id="page-top">

                                <div id="container">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                          <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>Nama</th>
                                              <th>Jabatan</th>
                                              <th>Keterangan</th>
                                              <th>Jumlah Izin</th>
                                              <th>Tanggal Mulai Izin</th>
                                              <th>Tanggal Akhir Izin</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach ($perizinan as $izin) : ?>
                                            <tr>
                                              <th><?= $i; ?></th>
                                              <td><?= $izin['nama']; ?></td>
                                              <td><?= $izin['jabatan']; ?></td>
                                              <td><?= $izin['keterangan']; ?></td>
                                              <td><?= $izin['jumlah_izin']; ?></td>
                                              <td><?= date("d F Y",strtotime($izin["tanggal_mulai"])); ?></td>
                                              <td><?= date("d F Y",strtotime($izin["tanggal_akhir"])); ?></td>
                                            </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                          </tbody>
                                        </table>
                                        </div>
                                     
                                </div>
                            
</body>

</html>