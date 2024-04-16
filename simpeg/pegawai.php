<?php 
session_start();

if (!isset($_SESSION['pegawai'])) {
   echo "<script>
         window.location.replace('session/login.php');
       </script>";
  exit;
}

require 'functions.php';


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
$date = date('y-m-d');
$username = $_SESSION['username'];

$pegawai = mysqli_query($conn, "SELECT * FROM pegawai WHERE username = '$username'");
foreach ($pegawai as $dp) {}

    $id_pegawai = $dp['id'];

$perizinan = mysqli_query($conn, "SELECT * FROM perizinan WHERE id_pegawai = '$id_pegawai' ORDER BY id DESC");
$kehadiran = mysqli_query($conn, "SELECT * FROM kehadiran WHERE id_pegawai = '$id_pegawai' ORDER BY id DESC");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'link.php'; ?>
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
    <script src="js/gps.js"></script>
    <link rel="stylesheet" href="css/print.css">
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
                           

                            <a id="btn-show" class="btn btn-warning mb-4 text-white"><i class="fas fa-plus"></i> Form Izin</a>

                            <div class="alert alert-warning">
                                Harap Menekan Tombol <b>Aktifkan Lokasi</b> Sebelum Absen!
                            </div>

                            <div style="display: flex;">

                            <button onclick="getLocation()" class="btn mr-5 btn-warning mb-4 text-white"><i class="fas fa-maps"></i>  Aktifkan Lokasi</button>
                             <!-- btn show -->
                             <form action="" method="post">
                                 <?php 
                                    $username = $_SESSION['username'];
                                    $peg = mysqli_query($conn, "SELECT * FROM pegawai WHERE username = '$username'");
                                 ?>

                                    <!-- Mengisi Data Secara Otomatis -->
                                <?php foreach ($peg as $de) : ?>
                                    <input type="hidden" id="id_pegawai" name="id_pegawai" value="<?= $de["id"]; ?>">
                                    <input type="hidden" id="tanggal" name="tanggal" value="<?= $date; ?>">
                                    <input type="hidden" id="nama" name="nama" value="<?= $de["nama"]; ?>">
                                    <input type="hidden" id="latitude" name="latitude" value="latitude">
                                    <input type="hidden" id="longitude" name="longitude" value="longitude">
                                <?php endforeach; ?>
                                <button  type="submit" name="hadir" class="btn btn-absen btn-info mb-4 text-white"><i class="fas fa-check"></i>  Absen</button>
                            </form>

                            </div>

                            <span id="form">

                            <span><a id="btn-hide" class="btn btn-danger mb-4 text-white"><i class="fas fa-minus-circle"></i> Tutup Form</a></span>
                            <!-- form -->
                            <div class="card shadow mb-4 p-3">
                                <?php $date = date('y-m-d'); ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php 
                                    $username = $_SESSION['username'];
                                    $user = mysqli_query($conn, "SELECT * FROM pegawai WHERE username = '$username'");
                                     ?>

                                    <!-- Mengisi Data Secara Otomatis -->
                                    <?php foreach ($user as $det) : ?>
                                    <input type="hidden" id="id_pegawai" name="id_pegawai" value="<?= $det["id"]; ?>">
                                    <input type="hidden" id="nama" name="nama" value="<?= $det["nama"]; ?>">
                                    <input type="hidden" id="jabatan" name="jabatan" value="<?= $det["jabatan"]; ?>">
                                    <?php endforeach; ?>
                                    <div class="mb-3">
                                         <input type="text" id="keterangan" name="keterangan" placeholder="Keterangan" required>
                                    </div>
                                    <div class="mb-3">
                                         <input type="number" id="jumlah_izin" name="jumlah_izin" placeholder="Jumlah Izin Diinginkan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Tanggal Mulai Izin</label>
                                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Tanggal Akhir Izin</label>
                                        <input type="date" id="tanggal_akhir" name="tanggal_akhir" required>
                                    </div>
                                    <button type="button" style="width: 100%;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                      Kirim
                                    </button>
                                    

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="alert alert-warning">
                                                Harap meng-konfirmasi perizinan terlebih dahulu ke whatsapp : <a target="_blank" href="https://wa.me/0895389756050?text=Permisi, Saya <?= $dp['nama']; ?> ingin meng-konfirmasi terkait perizinan dengan alasan .... . Terima Kasih.">+62895389756050</a> sebelum melakukan submit pada formulir ini.
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="izin" class="btn btn-info text-white">Kirim</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                </form>
                              </div>
                            </span>


                            <!-- Data -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#card-pegawai" id="judul" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="card-pegawai">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Perizinan</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="card-pegawai">
                                    <div class="card-body">
                                        <div class="my-3">
                                            <form action="" method="post">
                                                <label for="">Cari Data Berdasarkan Tanggal</label>
                                                <input type="month" name="keyword" id="keyword" class="mb-4">
                                              </form>
                                              <div class="alert alert-warning" role="alert">
                                                  <small>Harap Tekan <b>Enter</b> Setelah Memilih Bulan</small>
                                              </div>
                                        </div>
                                        <div class="table-responsive">
                                <div id="container">
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
                                   
                                        <a target="_blank" href="cetak-pegawai.php" id="btn-cetak" class="btn btn-info">Cetak Data</a>
                                    
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="ajax/perizinan.js"></script>

</body>

</html>