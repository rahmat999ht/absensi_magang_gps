<?php 
include '../koneksi.php';

$id = $_GET['id'];

$sql_h = "DELETE FROM tb_pembimbing WHERE id = '$id'";
$query = mysqli_query($koneksi, $sql_h);

if ($query) {
	header("location: ../datauser.php");
}else{
	echo "gagal dihapus";
}
 ?>

