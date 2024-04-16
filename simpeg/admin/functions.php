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

function add_pegawai($data) {
    global $conn;

    // htmlspecialchars berfungsi untuk tidak menjalankan script
    $username = htmlspecialchars($data["username"]);
    $password_sebelum = mysqli_real_escape_string($conn, $data["password"]);
    $foto = upload_foto();
    $nama = htmlspecialchars($data["nama"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $agama = htmlspecialchars($data["agama"]);
    $jabatan = htmlspecialchars($data["jabatan"]);
    $no_ktp = htmlspecialchars($data["no_ktp"]);
    $no_telpon = htmlspecialchars($data["no_telpon"]);
    
    
    // cek username sudah ada atau belum

    $cekusername = "SELECT * FROM pegawai where username = '$username'";
    $prosescek= mysqli_query($conn, $cekusername);

    if (mysqli_num_rows($prosescek)>0) { 
        echo "<script>alert('Username Sudah Pernah Digunakan!');history.go(-1) </script>";
        exit;
    }

    // // enkripsi password
    // $password = password_hash($password_sebelum, PASSWORD_DEFAULT);

    //     // tambahkan ke database
    //     // NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
    //     // sedangkan jika masih di localhost, bisa memakai ''
    // mysqli_query($conn, "INSERT INTO pegawai VALUES('', '$username', '$password', '$foto', '$nama', '$jenis_kelamin', '$alamat', '$agama', '$jabatan', '$no_ktp', '$no_telpon')");
    // return mysqli_affected_rows($conn);

    // enkripsi password
    $password = password_hash($password_sebelum, PASSWORD_DEFAULT);

        // tambahkan ke database
        // NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
        // sedangkan jika masih di localhost, bisa memakai ''
    mysqli_query($conn, "INSERT INTO pegawai VALUES('', '$username', '$password', '$foto', '$nama', '$jenis_kelamin', '$alamat', '$agama', '$jabatan', '$no_ktp', '$no_telpon')");
    return mysqli_affected_rows($conn);
}

function gaji($data) {
    global $conn;

    // htmlspecialchars berfungsi untuk tidak menjalankan script
    $id_pegawai = htmlspecialchars($data["id_pegawai"]);
    $tanggal_terima = htmlspecialchars($data["tanggal_terima"]);
    $rekap_hadir = htmlspecialchars($data["rekap_hadir"]);
    $rekap_izin = htmlspecialchars($data["rekap_izin"]);
    $jabatan = htmlspecialchars($data["jabatan"]);
    $nama = htmlspecialchars($data["nama"]);
    $gaji_pokok = htmlspecialchars($data["gaji_pokok"]);
    $bonus_gaji = htmlspecialchars($data["bonus_gaji"]);


    mysqli_query($conn, "INSERT INTO gaji VALUES('', '$id_pegawai', '$rekap_hadir', '$rekap_izin', '$tanggal_terima', '$nama', '$jabatan', '$gaji_pokok', '$bonus_gaji')");
    return mysqli_affected_rows($conn);
}

function add_super_user($data) {
    global $conn;

    // htmlspecialchars berfungsi untuk tidak menjalankan script
    $username = htmlspecialchars($data["username"]);
    $password_sebelum = mysqli_real_escape_string($conn, $data["password"]);
    $role = htmlspecialchars($data["role"]);
    
    
    // cek username sudah ada atau belum

    $cekusername2 = "SELECT * FROM super_user where username = '$username'";
    $prosescek2 = mysqli_query($conn, $cekusername2);

    if (mysqli_num_rows($prosescek2)>0) { 
        echo "<script>alert('Username Sudah Pernah Digunakan!');history.go(-1) </script>";
        exit;
    }

    // // enkripsi password
    // $password = password_hash($password_sebelum, PASSWORD_DEFAULT);

    //     // tambahkan ke database
    //     // NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
    //     // sedangkan jika masih di localhost, bisa memakai ''
    // mysqli_query($conn, "INSERT INTO super_user VALUES('', '$username', '$password', '$role')");
    // return mysqli_affected_rows($conn);

    // enkripsi password
    $password = $password_sebelum;

        // tambahkan ke database
        // NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
        // sedangkan jika masih di localhost, bisa memakai ''
    mysqli_query($conn, "INSERT INTO super_user VALUES('', '$username', '$password', '$role')");
    return mysqli_affected_rows($conn);
}


function upload_foto() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];


    $ekstensifoto = explode('.', $namaFile);
    $ekstensifoto = strtolower(end($ekstensifoto));

    // generate nama foto baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensifoto;
    move_uploaded_file($tmpName, '../foto/' . $namaFileBaru);

    return $namaFileBaru;
}
