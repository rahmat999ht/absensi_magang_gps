<?php 

include 'koneksi.php';
if (isset($_POST['simpan'])) {
	
	$id = $_POST['id'];
	$id_mahasiswa = $_POST['id_mahasiswa'];
	$nama = $_POST['nama'];
	$keterangan = $_POST['keterangan'];
	$alasan = $_POST['alasan'];
	$waktu = $_POST['waktu'];

	//untuk gambar
	$bukti = $_FILES['bukti']['name'];
	$tmp = $_FILES['bukti']['tmp_name'];
	$buktibaru = date('dmYHis').$bukti;
	$path = "images/".$buktibaru;


}

if (move_uploaded_file($tmp, $path)) {
	$sql = "SELECT * FROM tb_dokumentasi WHERE id = '".$id."'";
	mysqli_query($koneksi, $sql);

}




$query = "INSERT INTO tb_dokumentasi SET id_mahasiswa = '$id_mahasiswa', nama='$nama', keterangan='$keterangan', alasan='$alasan', waktu='$waktu', bukti='$buktibaru'";
mysqli_query($koneksi, $query);

if ($query) {
	echo "<script>alert('Anda sudah memberi keterangan') </script>";
	echo '<script>window.history.back()</script>';
}else{
	echo "gagal";
}

 ?>