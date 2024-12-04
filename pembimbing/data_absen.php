<?php
session_start();
require_once("../koneksi.php");
error_reporting(0);

$id_pembimbing = $_SESSION['id_pembimbing'];
// Ambil nama kelompok untuk pembimbing yang sedang login
$sql_kelompok = "
    SELECT k.nama_kelompok
    FROM tb_kelompok k
    JOIN tb_kelompok_pembimbing kp ON k.id_kelompok = kp.id_kelompok
    WHERE kp.id_pembimbing = '$id_pembimbing'
";
$query_kelompok = mysqli_query($koneksi, $sql_kelompok);
$kelompok = mysqli_fetch_assoc($query_kelompok);

// Konfigurasi Pagination
$per_halaman = 5; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$mulai = ($halaman > 1) ? ($halaman * $per_halaman) - $per_halaman : 0;

// Query untuk menghitung total data
$sql_count = "
SELECT COUNT(*) AS total 
FROM tb_absensi a
JOIN tb_mahasiswa m ON a.id_mahasiswa = m.id_mahasiswa
JOIN tb_kelompok_pembimbing kp ON kp.id_kelompok = a.id_kelompok
WHERE kp.id_pembimbing = '$id_pembimbing'
";

$query_count = mysqli_query($koneksi, $sql_count);
$total_data = mysqli_fetch_assoc($query_count)['total'];
$total_halaman = ceil($total_data / $per_halaman);

// Query untuk data sesuai halaman
$sql_pagination = "
SELECT a.*, m.nama, m.id_mahasiswa
FROM tb_absensi a
JOIN tb_mahasiswa m ON a.id_mahasiswa = m.id_mahasiswa
JOIN tb_kelompok_pembimbing kp ON kp.id_kelompok = a.id_kelompok
WHERE kp.id_pembimbing = '$id_pembimbing'
LIMIT $mulai, $per_halaman
";
$query_pagination = mysqli_query($koneksi, $sql_pagination);

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
    <title>Data Absen</title>

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
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location: ../index.php");
    } else {
        $username = $_SESSION['username'];
    }

    ?>
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
                            <a class="js-arrow" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>Beranda</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">

                            </ul>
                        </li>
                        <li>
                            <a href="data_absen.php">
                                <i class="fas fa-calendar-alt"></i>Data Absen</a>
                        </li>
                        <li>
                            <a href="data_izin.php">
                                <i class="fas fa-calendar-alt"></i>Data Izin</a>
                        </li>
                        <li>
                            <a href="data_dokumentasi.php">
                                <i class="fas fa-calendar-alt"></i>Data Dokumentasi</a>
                        </li>
                        <li>
                            <a href="data_mahasiswa.php">
                                <i class="fas fa-chart-bar"></i>Data Mahasiswa</a>
                        </li>
                        <li>
                            <a href="data_pembimbing.php">
                                <i class="fas fa-table"></i>Data Pembimbing</a>
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
                    <h2>Pembimbing</h2>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="dashboard.php">
                                <i class="fas fa-tachometer-alt"></i>Beranda</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">

                            </ul>
                        </li>
                        <li>
                            <a href="data_absen.php">
                                <i class="fas fa-calendar-alt"></i>Data Absen</a>
                        </li>
                        <li>
                            <a href="data_izin.php">
                                <i class="fas fa-calendar-alt"></i>Data Izin</a>
                        </li>
                        <li>
                            <a href="data_dokumentasi.php">
                                <i class="fas fa-calendar-alt"></i>Data Dokumentasi</a>
                        </li>
                        <li>
                            <a href="data_mahasiswa.php">
                                <i class="fas fa-chart-bar"></i>Data Mahasiswa</a>
                        </li>
                        <li>
                            <a href="data_pembimbing.php">
                                <i class="fas fa-table"></i>Data Pembimbing</a>
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
                            <form class="form-header" action="prospenab.php" method="POST">
                                <input autocomplete="off" class="au-input au-input--xl" type="text" name="cari" placeholder="Cari ID atau Nama mahasiswa" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->

            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <!-- Alert box for Nama Kelompok -->
                                <div class="alert alert-info">
                                    <h4>Nama Kelompok: <?php echo $kelompok['nama_kelompok']; ?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- Card for total absensi per mahasiswa -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Total Absensi per Mahasiswa</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        // Query to count the total absensi per mahasiswa
                                        $sql_absensi_count = "
                SELECT 
                    m.id_mahasiswa,
                    m.nama,
                    COUNT(DISTINCT a.id) AS total_absensi
                FROM tb_absensi a
                JOIN tb_mahasiswa m ON a.id_mahasiswa = m.id_mahasiswa
                JOIN tb_kelompok_pembimbing kp ON kp.id_kelompok = a.id_kelompok
                WHERE kp.id_pembimbing = '$id_pembimbing'
                GROUP BY m.id_mahasiswa
                ";

                                        // Execute the query to get the count of absensi per mahasiswa
                                        $result_absensi_count = mysqli_query($koneksi, $sql_absensi_count);

                                        // Fetch and display the total absensi for each mahasiswa
                                        while ($row_absensi_count = mysqli_fetch_array($result_absensi_count)) {
                                        ?>
                                            <p><?php echo $row_absensi_count['id_mahasiswa']; ?> <?php echo $row_absensi_count['nama']; ?> memiliki total absensi: <strong><?php echo $row_absensi_count['total_absensi']; ?></strong></p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>STB</th>
                                            <th>Nama</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Lokasi</th>
                                            <!-- <th>aksi</th> -->
                                        </tr>
                                    </thead>
                                    <?php
                                    include '../koneksi.php';
                                    // $sql = "SELECT * FROM tb_absensi";
                                    // Query untuk mendapatkan data absensi berdasarkan pembimbing yang login
                                    $no = $mulai + 1; // Penomoran data sesuai halaman
                                    while ($row = mysqli_fetch_array($query_pagination)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row['id_mahasiswa']; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['tgl_masuk']; ?></td>
                                            <td><?php echo $row['tgl_keluar']; ?></td>
                                            <td><?php echo $row['jam_masuk']; ?></td>
                                            <td><?php echo $row['jam_keluar']; ?></td>
                                            <td>
                                                <button class="btn btn-info btn-view-location" data-lat="<?php echo $row['lat']; ?>" data-long="<?php echo $row['long']; ?>">
                                                    Lihat Lokasi
                                                </button>
                                            </td>
                                            <!-- <td>
                                                <a href="hapus_absen.php?id=<?php echo $row['id']; ?>">
                                                    <button class="btn btn-danger" onclick="return confirm('Yakin ingin dihapus?');">Hapus</button>
                                                </a>
                                            </td> -->
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php echo ($halaman <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?halaman=<?php echo $halaman - 1; ?>">Previous</a>
                            </li>
                            <?php for ($x = 1; $x <= $total_halaman; $x++) { ?>
                                <li class="page-item <?php echo ($halaman == $x) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?halaman=<?php echo $x; ?>"><?php echo $x; ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?php echo ($halaman >= $total_halaman) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?halaman=<?php echo $halaman + 1; ?>">Next</a>
                            </li>
                        </ul>
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