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

    // Validasi ukuran dan tipe file foto
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
    $file_type = mime_content_type($tmp);
    $file_size = $_FILES['foto']['size'];
    
    if (in_array($file_type, $allowed_types) && $file_size <= 2000000) { // Maksimal 2MB
        if (move_uploaded_file($tmp, $path)) {
            // Cek apakah ID mahasiswa sudah ada
            $sql = "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$id_mahasiswa'";
            $tambah = mysqli_query($koneksi, $sql);

            if ($tambah && mysqli_num_rows($tambah) > 0) {
                echo "<script>alert('Data Dengan ID Mahasiswa = $id_mahasiswa sudah ada');</script>";
                echo "<script>window.location.href = 'data_mahasiswa.php'</script>";
            } else {
                // Insert data baru jika ID mahasiswa belum ada
                $query = "INSERT INTO tb_mahasiswa (id_mahasiswa, username, password, nama, tmp_tgl_lahir, jenkel, agama, alamat, no_tel, foto) 
                          VALUES ('$id_mahasiswa', '$username', '$password', '$nama', '$tmp_tgl_lahir', '$jenkel', '$agama', '$alamat', '$no_tel', '$fotobaru')";

                if (mysqli_query($koneksi, $query)) {
                    header("location: data_mahasiswa.php");
                } else {
                    echo "Gagal menyimpan data!";
                }
            }
        } else {
            echo "Gagal mengupload file!";
        }
    } else {
        echo "<script>alert('File harus berupa JPG atau PNG dan maksimal 2MB');</script>";
        echo "<script>window.location.href = 'data_mahasiswa.php'</script>";
    }
}
?>
