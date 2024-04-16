<?php 

// cek session
if (isset($_SESSION["notaris"])) {
    header("Location: ../notaris");
    exit;
}
if (isset($_SESSION["admin"])) {
    header("Location: ../admin");
    exit;
}
if (isset($_SESSION["pegawai"])) {
    header("Location: ../index.php");
    exit;
}
