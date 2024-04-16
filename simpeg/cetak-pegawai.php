<?php 
session_start();

require 'functions.php';

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
</head>

<body id="page-top">

    <h3 class="my-5">Data Perizinan</h3>

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
                                <script>window.print();</script>

</body>

</html>