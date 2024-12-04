<?php
session_start(); // Mulai session
require_once("../koneksi.php");
error_reporting(0);

// Ambil id mahasiswa dari session
$id_mahasiswa = $_SESSION['idsi'];

// Ambil id_kelompok milik mahasiswa berdasarkan id_mahasiswa yang sedang login
$query = "SELECT id_kelompok FROM tb_mahasiswa_kelompok WHERE id_mahasiswa = '$id_mahasiswa'";
$result = mysqli_query($koneksi, $query);
$data_mahasiswa = mysqli_fetch_assoc($result);
$id_kelompok_mahasiswa = $data_mahasiswa['id_kelompok'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Idiot-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Idiot-->
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Riwayat Absen</title>

    <!-- Fontfaces CSS-->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" media="all">
    <link href="../css/font-face.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- end script-->

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

<body class="animsition">
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
                            <a class="js-arrow" href="awal.php">
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
                            <a class="js-arrow" href="awal.php">
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
                                <input class="au-input au-input--xl" type="text" name="search" value="Riwayat Absen" readonly="" />
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
                            <div class="table-responsive table--no-card m-b-30">
                                <?php
                                // Query untuk menghitung total absensi
                                $total_absensi_sql = "SELECT COUNT(*) AS total_absensi
                                FROM tb_absensi
                                WHERE id_mahasiswa = $id_mahasiswa";
                                $total_absensi_query = mysqli_query($koneksi, $total_absensi_sql);
                                $total_absensi_data = mysqli_fetch_assoc($total_absensi_query);
                                $total_absensi = $total_absensi_data['total_absensi'];
                                ?>

                                <!-- Menampilkan Total Absensi -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <h4>Total Absensi: <?php echo $total_absensi; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Nama Kelompok</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Lokasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Mengambil data absensi beserta nama mahasiswa dan kelompok
                                        $sql = "
            SELECT 
                tb_absensi.*, 
                tb_mahasiswa.nama AS nama_mahasiswa,
                tb_kelompok.nama_kelompok
            FROM tb_absensi
            JOIN tb_mahasiswa ON tb_absensi.id_mahasiswa = tb_mahasiswa.id_mahasiswa
            JOIN tb_kelompok ON tb_absensi.id_kelompok = tb_kelompok.id_kelompok
            WHERE tb_absensi.id_mahasiswa = $id_mahasiswa
        ";

                                        $query = mysqli_query($koneksi, $sql);
                                        $no = 1;

                                        while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['nama_mahasiswa']; ?></td>
                                                <td><?php echo $row['nama_kelompok']; ?></td>
                                                <td><?php echo $row['tgl_masuk']; ?></td>
                                                <td><?php echo $row['tgl_keluar']; ?></td>
                                                <td><?php echo $row['jam_masuk']; ?></td>
                                                <td><?php echo $row['jam_keluar']; ?></td>
                                                <td>
                                                    <button class="btn btn-info btn-view-location" data-lat="<?php echo $row['lat']; ?>" data-long="<?php echo $row['long']; ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal untuk Menampilkan Peta -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lokasi Absen</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1HffggpnBUP6-cp8Gh_0UrfTatAvWKTk&callback=initMap" async defer></script>

    <script>
        let map;
        let marker;

        function initMap() {
            const defaultLocation = {
                lat: -6.200000,
                lng: 106.816666
            };
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 13,
            });
            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
            });
        }

        function loadLocation(latitude, longitude) {
            const location = {
                lat: parseFloat(latitude),
                lng: parseFloat(longitude)
            };
            map.setCenter(location);
            marker.setPosition(location);
        }

        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.btn-view-location').forEach(button => {
                button.addEventListener('click', function() {
                    const latitude = this.getAttribute('data-lat');
                    const longitude = this.getAttribute('data-long');

                    loadLocation(latitude, longitude);

                    $('#myModal').on('shown.bs.modal', function() {
                        google.maps.event.trigger(map, "resize");
                        map.setCenter({
                            lat: parseFloat(latitude),
                            lng: parseFloat(longitude)
                        });
                    }).modal('show');
                });
            });
        });
    </script>

    <!-- Jquery JS-->
    <script src="../vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../vendor/slick/slick.min.js">
    </script>
    <script src="../vendor/wow/wow.min.js"></script>
    <script src="../vendor/animsition/animsition.min.js"></script>
    <script src="../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="../js/main.js"></script>

</body>

</html>
<!-- end document-->