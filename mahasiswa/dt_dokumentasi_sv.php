<?php
session_start();
require_once("../koneksi.php"); // Pastikan koneksi database sudah benar

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nama = $_POST['nama'];
    $asal_kampus = $_POST['asal_kampus'];
    $bidang_penempatan = $_POST['bidang_penempatan'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $waktu = $_POST['waktu'];
    
    // Query untuk insert data
    $sql = "INSERT INTO tb_dokumentasi (id_mahasiswa, nama, asal_kampus, bidang_penempatan, nama_kegiatan, waktu) 
            VALUES ('$id_mahasiswa', '$nama', '$asal_kampus', '$bidang_penempatan', '$nama_kegiatan', '$waktu')";

    // Eksekusi query dan cek keberhasilan
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data dokumentasi berhasil disimpan!'); window.location.href='data_dokumentasi.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data dokumentasi: " . mysqli_error($koneksi) . "'); window.location.href='data_dokumentasi.php';</script>";
    }
}
?>
