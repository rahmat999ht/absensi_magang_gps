<?php
include '../koneksi.php';

if (isset($_POST['simpan_izin'])) {
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['alasan'];
    $alasan = $_POST['keterangan'];
    $waktu = date("Y-m-d H:i:s"); // Waktu dengan format timestamp

    // Query untuk menyimpan data izin
    $save_izin = "INSERT INTO `tb_izin` (`id_mahasiswa`, `nama`, `keterangan`, `alasan`, `waktu`) 
                  VALUES ('$id_mahasiswa', '$nama', '$keterangan', '$alasan', '$waktu')";

    if (mysqli_query($koneksi, $save_izin)) {
        echo "<script>alert('Data izin berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menyimpan data izin.');</script>";
    }

    echo "<script>window.location.href = 'data_izin.php';</script>";
}
?>