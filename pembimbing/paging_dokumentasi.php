<head>

</head>
<?php
include '../koneksi.php';

$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($koneksi, "SELECT * FROM tb_dokumentasi");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$data_karyawan = mysqli_query($koneksi, "SELECT * FROM tb_dokumentasi LIMIT $halaman_awal, $batas");
$nomor = $halaman_awal + 1;

while ($row = mysqli_fetch_array($data_karyawan)) {

?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['id_mahasiswa']; ?></td>
        <td><?php echo $row['nama']; ?></td>
        <td><?php echo $row['asal_kampus']; ?></td>
        <td><?php echo $row['bidang_penempatan']; ?></td>
        <td><?php echo $row['nama_kegiatan']; ?></td>
        <td><?php echo $row['waktu']; ?></td>
        <td><a href="hapus_dokumentasi.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger" onclick="return confirm('yakin ingin dihapus?');">Hapus</button></a></td>
    </tr>
<?php } ?>