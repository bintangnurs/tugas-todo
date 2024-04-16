<?php 

session_start();
require 'functions.php';

include 'cek-session.php';


 if (isset($_POST["login"])) {
  
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  $super_user = query("SELECT * FROM super_user WHERE username = '$username'");
  foreach ($super_user as $a) {}

  ini_set("display_errors", 0);
  
if ($a["role"] == 'Admin') {

    $result = mysqli_query($conn, "SELECT * FROM super_user WHERE username = '$username'");


  if (mysqli_num_rows($result) === 1 ) {
    

    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

                $_SESSION["login"] = true;
                $_SESSION["admin"] = true;
                $_SESSION["username"] = $username;

                header("Location: ../admin");
                exit;
    }

  } 

}
else if ($a["role"] == 'Notaris') {

    $result = mysqli_query($conn, "SELECT * FROM super_user WHERE username = '$username'");


  if (mysqli_num_rows($result) === 1 ) {
    

    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

                $_SESSION["login"] = true;
                $_SESSION["notaris"] = true;
                $_SESSION["username"] = $username;

                header("Location: ../notaris");
                exit;
    }

  } 

}
if ($a["role"] == 'Notaris') {

    $result = mysqli_query($conn, "SELECT * FROM super_user WHERE username = '$username'");


  if (mysqli_num_rows($result) === 1 ) {
    

    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

                $_SESSION["login"] = true;
                $_SESSION["notaris"] = true;
                $_SESSION["username"] = $username;

                header("Location: ../notaris");
                exit;
    }

  } 

}

 else {
  $result = mysqli_query($conn, "SELECT * FROM pegawai WHERE username = '$username'");


  if (mysqli_num_rows($result) === 1 ) {
    

    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {


            $_SESSION["login"] = true;
            $_SESSION["pegawai"] = true;
            $_SESSION["username"] = $username;

      header("Location: ../index.php");
      exit;
    }
  }
}

$error = true;
  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SISTEM INFORMASI MANAJEMEN KEPEGAWAIAN</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <?php include '../admin/animasi.php'; ?>

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Untuk Melanjutkan!</h1>
                                        <br>

                                        <?php if (isset($error)) : ?>
                                            <span class="badge text-light rounded-pill bg-danger mb-3">Username / Password Salah! <i class="fas fa-times-circle"></i></span>
                                        <?php endif; ?>

                                    </div>
                                    <form method="post" action="" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" name="username" aria-describedby="emailHelp"
                                                placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>