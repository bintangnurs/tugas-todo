<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "simpeg");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    };
    return $rows;
};

function add_kehadiran($data) {
    global $conn;

    // htmlspecialchars berfungsi untuk tidak menjalankan script
    $id_pegawai = htmlspecialchars($data["id_pegawai"]);
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $latitude = htmlspecialchars($data["latitude"]);
    $longitude = htmlspecialchars($data["longitude"]);

    // cek username sudah ada atau belum
    $date = date('y-m-d');
    $cekabsen = "SELECT * FROM kehadiran where id_pegawai = '$id_pegawai' AND tanggal = '$date'";
    $prosescek= mysqli_query($conn, $cekabsen);

    if (mysqli_num_rows($prosescek)>0) { 
        echo "<script>alert('Anda Sudah Absen Hari Ini!');history.go(-1) </script>";
        exit;
    }

    if ($latitude == 'latitude' AND $longitude == 'longitude') {
        echo "<script>alert('Harap Menyalakan Lokasi atau Izin-kan browser mengakses lokasi anda!');history.go(-1) </script>";
        exit;
    }
    

        // tambahkan ke database
        // NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
        // sedangkan jika masih di localhost, bisa memakai ''
    mysqli_query($conn, "INSERT INTO kehadiran VALUES('', '$id_pegawai', '$nama', '$tanggal', '$latitude', '$longitude')");
    return mysqli_affected_rows($conn);
}


function add_perizinan($data) {
    global $conn;

    // htmlspecialchars berfungsi untuk tidak menjalankan script
    $id_pegawai = htmlspecialchars($data["id_pegawai"]);
    $nama = mysqli_real_escape_string($conn, $data["nama"]);
    $jabatan = htmlspecialchars($data["jabatan"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $jumlah_izin = htmlspecialchars($data["jumlah_izin"]);
    $tanggal_mulai = htmlspecialchars($data["tanggal_mulai"]);
    $tanggal_akhir = htmlspecialchars($data["tanggal_akhir"]);
    

        // tambahkan ke database
        // NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
        // sedangkan jika masih di localhost, bisa memakai ''
    mysqli_query($conn, "INSERT INTO perizinan VALUES('', '$id_pegawai', '$nama', '$jabatan', '$keterangan', '$jumlah_izin', '$tanggal_mulai', '$tanggal_akhir')");
    return mysqli_affected_rows($conn);
}


