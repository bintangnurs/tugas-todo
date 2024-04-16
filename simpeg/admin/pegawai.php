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
                            <!-- btn show -->
                            <a id="btn-show" class="btn btn-info mb-4 text-white"><i class="fas fa-plus"></i> Tambah Data</a>

                            <span id="form">

                            <span><a id="btn-hide" class="btn btn-danger mb-4 text-white"><i class="fas fa-minus-circle"></i> Tutup Form</a></span>
                            <!-- form -->
                            <div class="card shadow mb-4 p-3">
                                <?php $date = date('y-m-d'); ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                         <input type="text" id="username" name="username" placeholder="Username" required>
                                    </div>
                                    <div class="mb-3">
                                         <input type="password" id="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto">Pas Photo</label>
                                        <input type="file" id="foto" name="foto" required>
                                    </div>
                                    <div class="mb-3">
                                         <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="mb-3">
                                        <select name="jenis_kelamin" id="jenis_kelamin">
                                            <option value="" hidden>Pilih Jenis Kelamin</option>
                                            <option value="Laki Laki">Laki Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                         <textarea id="alamat" name="alamat" placeholder="Alamat Lengkap" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                         <select type="text" id="agama" name="agama" required>
                                            <option value="" hidden>Pilih Agama</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Konghucu">Konghucu</option>
                                            <option value="Buddha">Buddha</option>
                                        <select>
                                    </div>
                                    <div class="mb-3">
                                         <input type="text" id="jabatan" name="jabatan" placeholder="Jabatan" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" id="no_ktp" name="no_ktp" placeholder="Nomor KTP" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="no_telpon"><small><span style="color: red;"><b>*Wajib Diawali 62</b></span></small></label>
                                        <input type="number" id="no_telpon" name="no_telpon" placeholder="Nomor Telepon (Cth : 6289987876651)" required>
                                    </div>
                                    <button type="submit" name="register" class="btn btn-info text-white" style="width: 100%;">Tambah</button>
                                </form>
                              </div>
                            </span>


                            <!-- Data -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#card-pegawai" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="card-pegawai">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
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
                                              <th>Username</th>
                                              <th>Nama</th>
                                              <th rowspan="2">Foto</th>
                                              <th>Jenis Kelamin</th>
                                              <th>Alamat</th>
                                              <th>Agama</th>
                                              <th>Jabatan</th>
                                              <th>No KTP</th>
                                              <th>No Telpon</th>
                                              <th colspan="2">Aksi</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach ($pegawai as $data) : ?>
                                            <tr>
                                              <th><?= $i; ?></th>
                                              <td><?= $data['username']; ?></td>
                                              <td><?= $data['nama']; ?></td>
                                              <td><a href="../foto/<?= $data['foto']; ?>" download><img src="../foto/<?= $data['foto']; ?>" width='50'></a>
                                              </td>
                                              <td><?= $data['jenis_kelamin']; ?></td>
                                              <td><?= $data['alamat']; ?></td>
                                              <td><?= $data['agama']; ?></td>
                                              <td><?= $data['jabatan']; ?></td>
                                              <td><?= $data['no_ktp']; ?></td>
                                              <td><?= $data['no_telpon']; ?></td>
                                              <td>
                                                  <a href="edit-pegawai.php?id=<?= $data['id']; ?>"><i class="fas fa-edit text-warning"></i></a>
                                              </td>
                                              <td>
                                                  <a href="hapus-pegawai.php?id=<?= $data['id']; ?>"><i class="fas fa-trash text-danger"></i></a>
                                              </td>
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