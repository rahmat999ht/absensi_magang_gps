<?php
session_start(); // Mulai session
require_once("../koneksi.php");
error_reporting(0);

date_default_timezone_set('Asia/Kuala_Lumpur'); // Set time zone secara konsisten

// Cek apakah mahasiswa sudah absen masuk hari ini
$id_mahasiswa = $_SESSION['idsi'];
$tanggal_hari_ini = date('Y-m-d');

// Ambil id_kelompok milik mahasiswa berdasarkan id_mahasiswa yang sedang login
$query = "SELECT id_kelompok FROM tb_mahasiswa_kelompok WHERE id_mahasiswa = '$id_mahasiswa'";
$result = mysqli_query($koneksi, $query);
$data_mahasiswa = mysqli_fetch_assoc($result);
$id_kelompok_mahasiswa = $data_mahasiswa['id_kelompok'];

$query = "SELECT * FROM tb_absensi WHERE id_kelompok = ? AND tgl_masuk = ?";
if ($koneksi) {
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("is", $id_kelompok_mahasiswa, $tanggal_hari_ini);
    $stmt->execute();
    $result = $stmt->get_result();
    $isAlreadyCheckedIn = $result->num_rows > 0;
} else {
    echo "Koneksi database tidak berhasil.";
    exit;
}

// Ambil nama kelompok berdasarkan id_kelompok
$query_kelompok = "SELECT * FROM tb_kelompok WHERE id_kelompok = '$id_kelompok_mahasiswa'";
$result_kelompok = mysqli_query($koneksi, $query_kelompok);
$data_kelompok = mysqli_fetch_assoc($result_kelompok);
$nama_kelompok = $data_kelompok['nama_kelompok'];
$lat_kelompok = $data_kelompok['lat'];
$lon_kelompok = $data_kelompok['lon'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Beranda Mahasiswa</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">\
    <!-- Google Maps API Script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1HffggpnBUP6-cp8Gh_0UrfTatAvWKTk&callback=initMap" async defer></script>

    <style>
        #map {
            height: 400px;
            /* Atur tinggi peta sesuai kebutuhan */
            width: 100%;
        }
    </style>

</head>
<?php date_default_timezone_set('Asia/Jakarta'); ?>

<body class="animsition" onload="initMap()">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo">
                            <img src="../images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Beranda</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">

                            </ul>
                        </li>
                        <li>
                            <a href="data_absen.php">
                                <i class="fas fa-calendar-alt"></i>Riwayat Absen</a>
                        </li>
                        <li>
                            <a href="data_izin.php">
                                <i class="fas fa-calendar-alt"></i>Riwayat Izin</a>
                        </li>
                        <li>
                            <a href="data_dokumentasi.php">
                                <i class="fas fa-calendar-alt"></i>Riwayat Dokumentasi</a>
                        </li>
                        <li>
                            <a href="profil.php">
                                <i class="fas fa-calendar-alt"></i>Profil</a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="zmdi zmdi-power"></i>Logout</a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <h2>Mahasiswa</h2>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="?m=awal">
                                <i class="fas fa-tachometer-alt"></i>Beranda</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            </ul>
                        </li>
                        <li>
                            <a href="data_absen.php">
                                <i class="fas fa-calendar-alt"></i>Riwayat Absen</a>
                        </li>
                        <li>
                            <a href="data_izin.php">
                                <i class="fas fa-calendar-alt"></i>Riwayat Izin</a>
                        </li>
                        <li>
                            <a href="data_dokumentasi.php">
                                <i class="fas fa-calendar-alt"></i>Riwayat Dokumentasi</a>
                        </li>
                        <li>
                            <a href="profil.php">
                                <i class="fas fa-calendar-alt"></i>Profil</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" value="absen mahasiswa" readonly="" />
                            </form>
                        </div>
                    </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1" style="text-align: center;">Selamat Datang <?php echo $_SESSION['namasi']; ?>, Silahkan Absen</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue">

                                </div>
                            </div>
                        </div>

                        <!-- FORM ABSENSI -->
                        <div class="row">
                            <div class="table-responsive table--no-card m-b-30">
                                <form action="dt_absen_sv.php" method="post">
                                    <div class="form-group">
                                        <table class="table table-borderless table-striped table-earning">
                                            <tbody>
                                                <tr>
                                                    <td>STB</td>
                                                    <td><input type="text" readonly class="form-control" name="id_mahasiswa" value="<?php echo $_SESSION['idsi']; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td><input type="text" readonly class="form-control" name="nama" value="<?php echo $_SESSION['namasi']; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td><input type="date" class="form-control" name="tanggal" value="<?php echo date('Y-m-d'); ?>" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Jam</td>
                                                    <td><input type="time" class="form-control" name="jam" value="<?php echo date('H:i', time() + (3600 * 1)); ?>" readonly></td>
                                                </tr>
                                                <!-- Peta untuk memilih lokasi -->
                                                <tr>
                                                    <td>Lokasi</td>
                                                    <td>
                                                        <div id="map"></div>
                                                        <input type="hidden" name="long2" id="longitude">
                                                        <input type="hidden" name="lat2" id="latitude">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Latitude Mahasiswa</td>
                                                    <td>
                                                        <input type="text" name="lat" id="form_latitude" readonly class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Longitude Mahasiswa</td>
                                                    <td>
                                                        <input type="text" name="long" id="form_longitude" readonly class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Lat Kantor</td>
                                                    <td>
                                                        <input type="text" name="lat_kelompok" id="lat_kelompok" readonly class="form-control" value="<?php echo $lat_kelompok; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Long Kantor</td>
                                                    <td>
                                                        <input type="text" name="lon_kelompok" id="lon_kelompok" readonly class="form-control" value="<?php echo $lon_kelompok; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kelompok</td>
                                                    <td>
                                                        <input type="hidden" name="id_kelompok" id="id_kelompok" readonly class="form-control" value="<?php echo $id_kelompok_mahasiswa; ?>">
                                                        <input type="text" name="nama_kelompok" id="nama_kelompok" readonly class="form-control" value="<?php echo $nama_kelompok; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button type="submit" name="absen_masuk" class="btn btn-primary" <?php if ($isAlreadyCheckedIn) echo 'disabled'; ?> onclick="updateLocationInputs()">Absen Masuk</button>
                                                        <button type="submit" name="absen_keluar" class="btn btn-danger" <?php if (!$isAlreadyCheckedIn) echo 'disabled'; ?> onclick="updateLocationInputs()">Absen Keluar</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1HffggpnBUP6-cp8Gh_0UrfTatAvWKTk&callback=initMap" async defer></script>


    <!-- Script untuk Google Maps dan Mendapatkan Lokasi -->
    <script>
        let map;
        let marker;

        function initMap() {
            // Lokasi default jika geolokasi gagal
            const defaultLocation = {
                lat: -6.200000, // Jakarta
                lng: 106.816666
            };

            // Inisialisasi peta
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 13,
            });

            // Tambahkan marker
            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
            });

            // Coba dapatkan lokasi pengguna
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        map.setCenter(userLocation);
                        map.setZoom(15);
                        marker.setPosition(userLocation);
                        updateLocationInputs(); // Tambahkan untuk memperbarui input saat lokasi ditemukan
                    },
                    () => {
                        console.error("Geolocation tidak diizinkan atau terjadi kesalahan.");
                        updateLocationInputs(); // Tetap perbarui dengan default lokasi
                    }
                );
            } else {
                console.error("Browser ini tidak mendukung Geolocation.");
                updateLocationInputs(); // Tetap perbarui dengan default lokasi
            }

            // Event listener saat marker dipindahkan
            marker.addListener("dragend", () => {
                const position = marker.getPosition();
                updateLocationInputs(position.lat(), position.lng());
            });

            // Event listener saat peta selesai dimuat (idle)
            map.addListener("idle", () => {
                const position = marker.getPosition();
                updateLocationInputs(position.lat(), position.lng());
            });
        }

        // Fungsi untuk memperbarui nilai latitude dan longitude di form
        function updateLocationInputs() {
            const currentLat = marker.getPosition().lat();
            const currentLng = marker.getPosition().lng();

            document.getElementById('form_latitude').value = currentLat;
            document.getElementById('form_longitude').value = currentLng;
        }
    </script>


    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->