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
  
  if (add_super_user($_POST) > 0 ) {
     echo "<script>
        alert('Data Berhasil Ditambahkan!');
        window.location.href='user.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 

function cari($keyword) {
    $query = "SELECT * FROM super_user
                WHERE
              username LIKE '%$keyword%' OR
              role LIKE '%$keyword%' 
            ";
    return query($query);
}

$super_user = mysqli_query($conn, 'SELECT * FROM super_user ORDER BY id DESC');

// jika tombol cari di tekan
if (isset($_POST["cari"])) {
    $super_user = cari($_POST["keyword"]);
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

    <center><h3 class="my-5">Data User</h3></center>

                                        <table class="table table-striped">
                                          <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>Username</th>
                                              <th>Role</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach ($super_user as $data) : ?>
                                            <tr>
                                              <th><?= $i; ?></th>
                                              <td><?= $data['username']; ?></td>
                                              <td><?= $data['role']; ?></td>
                                            </tr>
                                    <?php $i++; ?>
                                    <?php endforeach; ?>
                                          </tbody>
                                        </table>
                                 
    

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script>window.print();</script>
</body>

</html>