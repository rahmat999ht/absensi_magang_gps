<?php
session_start(); 
include '../koneksi.php';

if (isset($_POST['simpan'])) {

    $id_mahasiswa = $_POST['id_mahasiswa'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $tmp_tgl_lahir = $_POST['tmp_tgl_lahir'];
    $jenkel = $_POST['jenkel'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $no_tel = $_POST['no_tel'];

    // Proses upload foto
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $fotobaru = date('dmYHis') . $foto;
    $path = "../images/" . $fotobaru;

    if (move_uploaded_file($tmp, $path)) {
        // Cek apakah NIP sudah ada
        $sql = "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$id_mahasiswa'";
        $tambah = mysqli_query($koneksi, $sql);

        if ($tambah && mysqli_num_rows($tambah) > 0) {
            echo "<script>alert('Data Dengan NIP = $id_mahasiswa sudah ada')</script>";
            echo "<script>window.location.href = 'datamahasiswa.php'</script>";
        } else {
            // Jika tidak ada, insert data baru
            $query = "INSERT INTO tb_mahasiswa SET id_mahasiswa='$id_mahasiswa', username='$username', password='$password', nama='$nama', tmp_tgl_lahir='$tmp_tgl_lahir', jenkel='$jenkel', agama='$agama', alamat='$alamat', no_tel='$no_tel', jabatan='$jabatan', foto='$fotobaru'";

            if (mysqli_query($koneksi, $query)) {
                header("location: datamahasiswa.php");
            } else {
                echo "Gagal menyimpan data!";
            }
        }
    } else {
        echo "Gagal mengupload file!";
    }
}
?>
