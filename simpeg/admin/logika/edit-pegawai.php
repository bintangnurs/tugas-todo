<?php 

if (isset($_POST['ubah_gambar'])) {
    
    function ubah_with_gambar($data) {
        global $conn;
        $id = $_GET["id"];
        $pegawai = query("SELECT * FROM pegawai WHERE id = $id")[0];
         
        $id = $_GET["id"];
        $username = $data["username"];
        $foto = upload_foto();
        $nama = $data["nama"];
        $jenis_kelamin = $data["jenis_kelamin"];
        $alamat = $data["alamat"];
        $agama = $data["agama"];
        $jabatan = $data["jabatan"];
        $no_ktp = $data["no_ktp"];
        $no_telpon = $data["no_telpon"];
        

        

        $query = "UPDATE pegawai SET 
                    username = '$username',
                    foto = '$foto',
                    nama = '$nama',
                    jenis_kelamin = '$jenis_kelamin',
                    alamat = '$alamat',
                    agama = '$agama',
                    jabatan = '$jabatan',
                    no_ktp = '$no_ktp',
                    no_telpon = '$no_telpon'
                  WHERE id = $id
                ";
                
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

}

if (!isset($_POST['ubah_gambar'])) {
    function ubah_without_both($data) {
        global $conn;
        $id = $_GET["id"];
        $pegawai = query("SELECT * FROM pegawai WHERE id = $id")[0];
         
        $id = $_GET["id"];
        $username = $data["username"];
        $nama = $data["nama"];
        $jenis_kelamin = $data["jenis_kelamin"];
        $alamat = $data["alamat"];
        $agama = $data["agama"];
        $jabatan = $data["jabatan"];
        $no_ktp = $data["no_ktp"];
        $no_telpon = $data["no_telpon"];

        $query = "UPDATE pegawai SET 
                    username = '$username',
                    nama = '$nama',
                    jenis_kelamin = '$jenis_kelamin',
                    alamat = '$alamat',
                    agama = '$agama',
                    jabatan = '$jabatan',
                    no_ktp = '$no_ktp',
                    no_telpon = '$no_telpon'
                  WHERE id = $id
                ";
                
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}