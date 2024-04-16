<?php 

if (isset($_POST['ubah_password'])) {
    
    function ubah_with_password($data) {
        global $conn;
        $id = $_GET["id"];
        $super_user = query("SELECT * FROM super_user WHERE id = $id")[0];
         
        $id = $_GET["id"];
        $username = $data["username"];
        $password_sebelum = mysqli_real_escape_string($conn, $data["password"]);
        $role = $data["role"];
        
        // enkripsi password
        $password = password_hash($password_sebelum, PASSWORD_DEFAULT);

        

        $query = "UPDATE super_user SET 
                    username = '$username',
                    password = '$password',
                    role = '$role'
                  WHERE id = $id
                ";
                
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

}

if (!isset($_POST['ubah_password'])) {
    function ubah_without_password($data) {
        global $conn;
        $id = $_GET["id"];
        $super_user = query("SELECT * FROM super_user WHERE id = $id")[0];
         
        $id = $_GET["id"];
        $username = $data["username"];
        $role = $data["role"];

        $query = "UPDATE super_user SET 
                    username = '$username',
                    role = '$role'
                  WHERE id = $id
                ";
                
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }
}