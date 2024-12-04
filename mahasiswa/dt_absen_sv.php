<?php
include '../koneksi.php';

function distance($lat1, $lon1, $lat2, $lon2)
{
    $theta = $lon1 - $lon2;
    $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) +
        (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $kilometers = $miles * 1.609344;
    $meters = $kilometers * 1000;
    return $meters;
}


date_default_timezone_set('Asia/Kuala_Lumpur'); // Set time zone secara konsisten

if (isset($_POST['absen_masuk']) || isset($_POST['absen_keluar'])) {

    $id_mahasiswa = $_POST['id_mahasiswa'];
    $id_kelompok = $_POST['id_kelompok'];
    $nama_kelompok = $_POST['nama_kelompok'];
    $tgl_absen = date("Y-m-d"); // Tanggal absen (hari ini)
    $jam_sekarang = date("H:i:s"); // Jam saat ini

    // Lokasi mahasiswa
    $longitude = $_POST['long'];
    $latitude = $_POST['lat'];

    // Lokasi acuan (misalnya, kantor)
    $lon_kelompok = $_POST['lon_kelompok'];
    $lat_kelompok = $_POST['lat_kelompok'];

    // Hitung jarak
    $jarak = distance($latitude, $longitude, $lat_kelompok, $lon_kelompok);

    // Cek apakah sudah absen untuk hari ini
    $cek_absen = mysqli_query($koneksi, "SELECT * FROM tb_absensi WHERE id_mahasiswa='$id_mahasiswa' AND tgl_masuk='$tgl_absen'");
    $data_absen = mysqli_fetch_array($cek_absen);

    // Validasi jarak
    $radius = 100; // 100 meter
    if ($jarak > $radius) {
        echo "<script>alert('Gagal absen. Anda berada di luar jangkauan (radius 100m).');</script>";
        echo "<script>window.location.href = 'index.php?m=awal';</script>";
        exit;
    }
    
    if (isset($_POST['absen_masuk'])) {
        if ($data_absen && !empty($data_absen['jam_masuk'])) {
            echo "<script>alert('Anda sudah melakukan absen masuk hari ini!');</script>";
        } else {
            // Simpan data absen masuk
            $save = "INSERT INTO `tb_absensi` (`id_mahasiswa`, `id_kelompok`, `nama_kelompok`, `tgl_masuk`, `jam_masuk`, `long`, `lat`) VALUES ('$id_mahasiswa', '$id_kelompok', '$nama_kelompok', '$tgl_absen', '$jam_sekarang', '$longitude', '$latitude')";
            if (mysqli_query($koneksi, $save)) {
                echo "<script>alert('Absen masuk berhasil!');</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat menyimpan absen masuk.');</script>";
            }
        }
    } elseif (isset($_POST['absen_keluar'])) {
        if ($data_absen && !empty($data_absen['jam_keluar'])) {
            echo "<script>alert('Anda sudah melakukan absen keluar hari ini!');</script>";
        } else
		if ($data_absen) {
            // Update data absen keluar
            $update = "UPDATE `tb_absensi` SET `jam_keluar`='$jam_sekarang', `tgl_keluar`='$tgl_absen', `long`='$longitude', `lat`='$latitude' WHERE `id_mahasiswa`='$id_mahasiswa' AND `tgl_masuk`='$tgl_absen'";
            if (mysqli_query($koneksi, $update)) {
                echo "<script>alert('Absen keluar berhasil!');</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat menyimpan absen keluar.');</script>";
            }
        } else {
            echo "<script>alert('Anda belum melakukan absen masuk hari ini!');</script>";
        }
    }

    echo "<script>window.location.href = 'index.php?m=awal';</script>";
}
