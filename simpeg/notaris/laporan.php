<?php 
session_start();

if (!isset($_SESSION['notaris'])) {
   echo "<script>
         window.location.replace('../session/login.php');
       </script>";
  exit;
}

require 'functions.php';


function cari($keyword) {
    $query = "SELECT * FROM gaji
                WHERE
              tanggal_terima LIKE '%$keyword%'
            ";
    return query($query);
}

function cari2($keyword) {
    $query = "SELECT SUM(gaji_pokok) as seluruh FROM gaji
                WHERE
              tanggal_terima LIKE '%$keyword%'
            ";
    return query($query);
}



$pegawai = mysqli_query($conn, "SELECT * FROM gaji");
$seluruh = mysqli_query($conn, "SELECT SUM(gaji_pokok) as seluruh FROM gaji");


// jika tombol cari di tekan
if (isset($_POST["cari"])) {
    $pegawai = cari($_POST["keyword"]);
    $seluruh = cari2($_POST["keyword"]);
} 

foreach ($seluruh as $d ) {}

$seluruh_gaji = $d['seluruh'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'link.php'; ?>
    <link rel="stylesheet" href="../css/print.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
         $(document).ready(function() {

         $("#form").hide();

         $("#btn-show").click(function() {
           $("#form").show();
         })

         $("#btn-hide").click(function() {
           $("#form").hide();
         })

       });
    </script>
    <style>
        table img {
            transition: 0.5s;
        }
        table img:hover {
            transition: 0.5s;
            transform: scale(2.5);
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">


                        <div class="col mb-4">

                            <!-- Data -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#card-pegawai" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="card-pegawai">
                                    <h6 class="m-0 font-weight-bold text-primary">Laporan Bulanan</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="card-pegawai">
                                    <div class="card-body">
                                        <div class="my-3">
                                            <form action="" method="post">
                                                <center>
                                                <input type="month" name="keyword" style="width: 60%;" autofocus placeholder="Ketik Keyword Pencarian..." autocomplete="off">
                                                <button class="btn text-primary" type="submit" name="cari"><i class="fab fa-searchengin"></i></button>
                                                </center> 
                                            </form>
                                        </div>
                                        <div class="table-responsive">
                                        <table class="table table-striped" style="width: 100%;">
                                          <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>Nama</th>
                                              <th>Tanggal Terima</th>
                                              <th>Jumlah Hadir</th>
                                              <th>Jumlah Izin</th>
                                              <th>Gaji Bersih</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach ($pegawai as $data) : ?>
                                            <tr>
                                              <th><?= $i; ?></th>
                                              <td><?= $data['nama']; ?></td>
                                              <td><?= $data['tanggal_terima']; ?></td>
                                              <td><?= $data['rekap_hadir']; ?></td>
                                              <td><?= $data['rekap_izin']; ?></td>
                                              <td>Rp <?= number_format($data['gaji_pokok'],2,',','.'); ?></td>
                                            </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                          </tbody>
                                        </table>
                                        <hr>
                                            <div style="display: flex;justify-content: space-between;">
                                                <p class="mr-5 mt-3">
                                                    Jumlah Seluruh Gaji Karyawan Diterima : Rp<?= number_format($seluruh_gaji,2,',','.'); ?>
                                                </p>
                                                <p class="mr-5 mt-3">
                                                    <button onclick="window.print();" class="btn btn-info sa">Cetak Laporan</button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include 'footer.php' ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>