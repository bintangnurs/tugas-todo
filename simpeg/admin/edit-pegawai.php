<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../session/login.php');
       </script>";
  exit;
}

require 'functions.php';


$id = $_GET["id"];
$pegawai = query("SELECT * FROM pegawai WHERE id = $id")[0];

include 'logika/edit-pegawai.php';

if (isset($_POST["edit"])) {

  if (isset($_POST['ubah_gambar'])) {

      if (ubah_with_gambar($_POST) > 0) {
         echo "<script>
            alert('Data Berhasil Di-Edit!');
            window.location.href='pegawai.php';
          </script>";
      } else {
        echo mysqli_error($conn);
      }
  }


if (!isset($_POST['ubah_gambar'])) {

  if (ubah_without_both($_POST) > 0) {
     echo "<script>
        alert('Data Berhasil Di-Edit!');
        window.location.href='pegawai.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }
}

} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'link.php'; ?>
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
                            <h3>Edit Data Pegawai</h3>
                            <!-- form -->
                            <div class="card shadow mb-4 p-3">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                         <input type="text" id="username" name="username" placeholder="Username" required value="<?= $pegawai['username']; ?>">
                                    </div>
                                    <div class="mb-3 px-5 pt-2">
                                        <input type="checkbox" id="ubah_gambar" name="ubah_gambar">
                                        <label for="ubah_gambar">Centang jika ingin mengubah foto</label>
                                        <br>
                                        <span class="badge text-light rounded-pill bg-danger mb-3">Kosongkan jika tidak ingin merubah foto <i class="fas fa-info-circle"></i></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto">Pas Photo</label>
                                        <input type="file" id="foto" name="foto">
                                    </div>
                                    <div class="mb-3">
                                         <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required value="<?= $pegawai['nama']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <select name="jenis_kelamin" id="jenis_kelamin">
                                            <option value="<?= $pegawai["jenis_kelamin"]; ?>" hidden><?= $pegawai["jenis_kelamin"]; ?></option>
                                            <option value="Laki Laki">Laki Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                         <textarea id="alamat" name="alamat" placeholder="Alamat Lengkap" required><?= $pegawai['alamat']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" id="agama" name="agama" placeholder="Agama" required value="<?= $pegawai['agama']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" id="jabatan" name="jabatan" placeholder="Jabatan" required value="<?= $pegawai['jabatan']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" id="no_ktp" name="no_ktp" placeholder="Nomor KTP" required value="<?= $pegawai['no_ktp']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" id="no_telpon" name="no_telpon" placeholder="Nomor Telepon" required value="<?= $pegawai['no_telpon']; ?>">
                                    </div>
                                    <button type="submit" name="edit" class="btn btn-info text-white" style="width: 100%;">Edit</button>
                                    <br><br>
                                    <a href="pegawai.php" class="btn btn-danger text-white" style="width: 100%;">Batal</a>
                                </form>
                              </div>
                                
                       
                        </div>

                        <!-- End Row -->
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