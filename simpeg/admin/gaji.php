<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../session/login.php');
       </script>";
  exit;
}

require 'functions.php';


if (isset($_POST["register"])) {
  
  if (add_pegawai($_POST) > 0 ) {
     echo "<script>
        alert('Data Berhasil Ditambahkan!');
        window.location.href='pegawai.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 


if (isset($_POST["gaji"])) {
  
  if (gaji($_POST) > 0 ) {
     echo "<script>
        alert('Gaji Berhasil di-Proses!');
        window.location.href='gaji.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 

function cari($keyword) {
    $query = "SELECT * FROM pegawai
                WHERE
              username LIKE '%$keyword%' OR
              password LIKE '%$keyword%' OR
              foto LIKE '%$keyword%' OR
              nama LIKE '%$keyword%' OR
              jenis_kelamin LIKE '%$keyword%' OR
              alamat LIKE '%$keyword%' OR
              agama LIKE '%$keyword%' OR
              jabatan LIKE '%$keyword%' OR
              no_ktp LIKE '%$keyword%' OR
              no_telpon LIKE '%$keyword%' 
            ";
    return query($query);
}

$pegawai = mysqli_query($conn, 'SELECT * FROM pegawai ORDER BY id DESC');

// jika tombol cari di tekan
if (isset($_POST["cari"])) {
    $pegawai = cari($_POST["keyword"]);
} 

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
                                    <h6 class="m-0 font-weight-bold text-primary">Kelola Gaji</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="card-pegawai">
                                    <div class="card-body">
                                        <div class="my-3">
                                            <form action="" method="post">
                                                <center>
                                                <input type="text" name="keyword" style="width: 60%;" autofocus placeholder="Ketik Keyword Pencarian..." autocomplete="off">
                                                <button class="btn text-primary" type="submit" name="cari"><i class="fab fa-searchengin"></i></button>
                                                </center> 
                                            </form>
                                        </div>
                                        <div class="table-responsive">
                                        <table class="table table-striped">
                                          <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>Aksi</th>
                                              <th>Username</th>
                                              <th>Nama</th>
                                              <th>No KTP</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach ($pegawai as $data) : ?>
                                            <tr>
                                              <th><?= $i; ?></th>
                                              <td>


            <?php $tanggal_ini = date('y-m-d'); $bulan_ini = date('m'); $id_pegawai = $data['id']; ?>
            <?php $gaji = mysqli_query($conn, "SELECT * FROM gaji WHERE tanggal_terima = '$tanggal_ini' AND id_pegawai = '$id_pegawai'"); ?>
            <?php foreach ($gaji as $dg) {
                // code...
            } ?>
            <?php if (mysqli_num_rows($gaji) > 0) : ?>
                <p class="text-success"><b>Telah Menerima Gaji Bulan Ini</b></p>
                <p>Gaji Pokok Diterima : Rp<?= number_format($dg['gaji_pokok'],2,',','.'); ?></p>
            <?php else: ?>
                                                  
            <form action="" method="post">
                <input type="hidden" id="id_pegawai" name="id_pegawai" value="<?= $data["id"]; ?>">
                <input type="hidden" id="tanggal_terima" name="tanggal_terima" value="<?= $tanggal_ini; ?>">
                <input type="hidden" id="nama" name="nama" value="<?= $data['nama']; ?>">
                <input type="hidden" id="jabatan" name="jabatan" value="<?= $data['jabatan']; ?>">

                <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" placeholder="Input Gaji Pokok" required>
                <br>


                <?php 
                    $id_pegawai = $data['id'];
                    $data_hadir = mysqli_query($conn, "SELECT * FROM kehadiran WHERE id_pegawai = '$id_pegawai' AND month(tanggal) = '$bulan_ini'");
                    $jumlah_hadir = mysqli_num_rows($data_hadir);
                    // -------------------------------------------------------------------------------- //
                    $data_izin = mysqli_query($conn, "SELECT SUM(jumlah_izin) as jumlah FROM perizinan WHERE id_pegawai = '$id_pegawai' AND month(tanggal_mulai) = '$bulan_ini'");
                    foreach ($data_izin as $izin) {}
                    $jumlah_izin = $izin['jumlah'];

                    if ($jumlah_hadir >= 24) {
                        $bonus = 600000;
                    } else {
                        $bonus = 0;
                    }

                    if ($jumlah_izin >= 1 AND $jumlah_izin <= 8 ) {
                        $bonus = 400000;
                    } elseif ($jumlah_izin > 8 ) {
                        $bonus = 0;
                    }

                 ?>

                 <input type="hidden" id="rekap_hadir" name="rekap_hadir" value="<?= $jumlah_hadir; ?>">
                 <input type="hidden" id="rekap_izin" name="rekap_izin" value="<?= $jumlah_izin; ?>">
                 <input type="hidden" id="bonus_gaji" name="bonus_gaji" value="<?= $bonus; ?>">

                <button type="button" style="width: 100%;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Proses Gaji
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
                            Harap meng-konfirmasi terlebih dahulu ke whatsapp : <a target="_blank" href="https://wa.me/<?= $data['no_telpon']; ?>?text=Permisi, Izin mengabarkan bahwa gaji anda telah dikirim, silahkan periksa rekening bank anda. Terima Kasih"><?= $data['no_telpon']; ?></a> sebelum mem-proses gaji.
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="gaji" class="btn btn-info">Proses Gaji</button>
                      </div>
                    </div>
                  </div>
                </div>
                
            </form>

            <?php endif; ?>


                                              </td>
                                              <td><?= $data['username']; ?></td>
                                              <td><?= $data['nama']; ?></td>
                                              <td><?= $data['no_ktp']; ?></td>
                                              
                                            </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                          </tbody>
                                        </table>
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