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
$super_user = query("SELECT * FROM super_user WHERE id = $id")[0];

include 'logika/edit-super_user.php';

if (isset($_POST["edit"])) {

if (isset($_POST['ubah_password'])) {

      if (ubah_with_password($_POST) > 0) {
         echo "<script>
            alert('Data Berhasil Di-Edit!');
            window.location.href='user.php';
          </script>";
      } else {
        echo mysqli_error($conn);
      }
}


if (!isset($_POST['ubah_password'])) {

  if (ubah_without_password($_POST) > 0) {
     echo "<script>
        alert('Data Berhasil Di-Edit!');
        window.location.href='user.php';
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
                            <h3>Edit Data User</h3>
                            <!-- form -->
                            <div class="card shadow mb-4 p-3">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                         <input type="text" id="username" name="username" placeholder="Username" required value="<?= $super_user['username']; ?>">
                                    </div>
                                    <div class="mb-3 px-5 pt-2">
                                        <input type="checkbox" id="ubah_password" name="ubah_password">
                                        <label for="ubah_password">Centang jika ingin mengubah password</label>
                                        <br>
                                        <span class="badge text-light rounded-pill bg-danger mb-3">Kosongkan jika tidak ingin merubah password <i class="fas fa-info-circle"></i></span>
                                    </div>
                                    <div class="mb-3">
                                         <input type="password" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="mb-3">
                                        <select name="role" id="role">
                                            <option value="<?= $super_user["role"]; ?>" hidden><?= $super_user["role"]; ?></option>
                                            <option value="Admin">Admin</option>
                                            <option value="Notaris">Notaris</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="edit" class="btn btn-info text-white" style="width: 100%;">Edit</button>
                                    <br><br>
                                    <a href="user.php" class="btn btn-danger text-white" style="width: 100%;">Batal</a>
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