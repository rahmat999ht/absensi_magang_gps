<?php 
include 'koneksi.php';
session_start();

$id = $_GET['id_mahasiswa'];
$sql = "SELECT *  FROM tb_mahasiswa WHERE id_mahasiswa = '$id'";
$query = mysqli_query($koneksi, $sql);
$hapus_f = mysqli_fetch_array($query);

//proses hapus gambar
$file = "images/".$hapus_f['foto'];
unlink($file);

$sql_h = "DELETE FROM tb_mahasiswa WHERE id_mahasiswa = '$id' ";
$hapus = mysqli_query($koneksi, $sql_h);

if ($hapus) {
         
         header("location: datakaryawan.php");
} else {
  echo "Gagal Dihapus";
}

 ?>

