<?php
session_start();
error_reporting(0);
include '../koneksi.php';

if (isset($_POST['ubahdata'])) {
  $id_mahasiswa = $_POST['id_mahasiswa'];
  $username = $_POST['username'];
  $nama = $_POST['nama'];
  $tmp_tgl_lahir = $_POST['tmp_tgl_lahir'];
  $jenkel = $_POST['jenkel'];
  $agama = $_POST['agama'];
  $alamat = $_POST['alamat'];
  $no_tel = $_POST['no_tel'];

  if (isset($_POST['ubahfoto'])) { // Cek apakah user ingin mengubah foto
    $foto = $_FILES['inpfoto']['name'];
    $tmp = $_FILES['inpfoto']['tmp_name'];
    $fotobaru = date('dmYHis') . $foto;
    $path = "../images/" . $fotobaru;

    if (move_uploaded_file($tmp, $path)) {
      $sql = "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$id_mahasiswa'";
      $query = mysqli_query($koneksi, $sql);
      $hapus_f = mysqli_fetch_array($query);

      // Hapus gambar lama
      $file = "../images/" . $hapus_f['foto'];
      if (file_exists($file)) {
        unlink($file);
      }

      // Update data dengan foto baru
      $sql_f = "UPDATE tb_mahasiswa SET username='$username', nama='$nama', tmp_tgl_lahir='$tmp_tgl_lahir', jenkel='$jenkel', agama='$agama', alamat='$alamat', no_tel='$no_tel', foto='$fotobaru' WHERE id_mahasiswa='$id_mahasiswa'";
      $ubah = mysqli_query($koneksi, $sql_f);

      if ($ubah) {
        echo "<script>alert('Ubah Data Dengan ID mahasiswa = $id_mahasiswa Berhasil');</script>";
        echo "<script>window.location.href = 'datakaryawan.php';</script>";
      } else {
        echo "Maaf, Terjadi kesalahan saat mencoba menyimpan data.";
        echo "<br><a href='edit_karyawan.php?id_mahasiswa=$id_mahasiswa'> Kembali Ke Form</a>";
      }
    } else {
      echo "Maaf, Gambar gagal diupload.";
      echo "<br><a href='datakaryawan.php'>Kembali Ke Data Karyawan</a>";
    }
  } else {
    // Hanya update data tanpa foto
    $sql_d = "UPDATE tb_mahasiswa SET username='$username', nama='$nama', tmp_tgl_lahir='$tmp_tgl_lahir', jenkel='$jenkel', agama='$agama', alamat='$alamat', no_tel='$no_tel' WHERE id_mahasiswa='$id_mahasiswa'";
    $data = mysqli_query($koneksi, $sql_d);

    if ($data) {
      echo "<script>alert('Ubah Data Dengan ID mahasiswa = $id_mahasiswa Berhasil');</script>";
      echo "<script>window.location.href = 'datakaryawan.php';</script>";
    } else {
      echo "Maaf, Terjadi kesalahan saat mencoba menyimpan data.";
      echo "<br><a href='edit_karyawan.php?id_mahasiswa=$id_mahasiswa'> Kembali Ke Form</a>";
    }
  }
}
?>
