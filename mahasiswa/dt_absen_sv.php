<?php
include '../koneksi.php';
if (isset($_POST['simpan'])) {
	$id_mahasiswa = $_POST['id_mahasiswa'];
	$nama = $_POST['nama'];
	$waktu = $_POST['waktu'];


}

$save = "INSERT INTO tb_absensi SET id_mahasiswa='$id_mahasiswa', nama='$nama', waktu='$waktu'";
mysqli_query($koneksi, $save);

if ($save) {
	echo "<script>alert('Anda sudah absen untuk hari ini') </script>";
	 echo "<script>window.location.href = \"index.php?m=awal\" </script>";	
}else{
	echo "kryptosssss";
}

 ?>