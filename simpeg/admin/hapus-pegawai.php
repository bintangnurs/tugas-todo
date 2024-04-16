<?php 
require 'functions.php';

function hapus_pegawai($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM pegawai WHERE id = $id");

	return mysqli_affected_rows($conn);
}

$id = $_GET["id"];
if (hapus_pegawai($id) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'pegawai.php';
		</script>
	";
    } else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = 'pegawai.php';
		</script>
	";
	}
 ?>