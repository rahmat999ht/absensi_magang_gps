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
        header("location: index.php");
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
                        <!-- <li>
                            <a href="data_izin.php">
                                <i class="fas fa-calendar-alt"></i>Data Izin</a>
                        </li> -->
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
                        <!-- <li>
                            <a href="data_izin.php">
                                <i class="fas fa-calendar-alt"></i>Data Izin</a>
                        </li> -->
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
                            <a href="datamahasiswa.php">
                                <i class="fas fa-chart-bar"></i>Data Mahasiswa</a>
                        </li>
                        <li>
                            <a href="datauser.php">
                                <i class="fas fa-table"></i>Data Pembimbing</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </header>
        <!-- END HEADER MOBILE-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="prospenab.php" method="POST">
                                <input autocomplete="off" class="au-input au-input--xl" type="text" name="cari" placeholder="Cari ID atau Nama Mahasiswa" />
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
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Statistik Kehadiran Mahasiswa</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        if (isset($_POST['cari']) && !empty($_POST['cari'])) {
                                            // Escape input untuk mencegah SQL Injection
                                            $cari = mysqli_real_escape_string($koneksi, $_POST['cari']);

                                            // Query untuk statistik kehadiran
                                            $sql_statistik = "
        SELECT 
            m.id_mahasiswa,
            m.nama,
            COUNT(DISTINCT a.id) AS total_hadir,
            COUNT(DISTINCT CASE WHEN i.keterangan = 'Izin' THEN i.id END) AS total_izin,
            COUNT(DISTINCT CASE WHEN i.keterangan = 'Sakit' THEN i.id END) AS total_sakit
        FROM tb_mahasiswa m
        JOIN tb_mahasiswa_kelompok mk ON m.id_mahasiswa = mk.id_mahasiswa
        JOIN tb_kelompok_pembimbing kp ON mk.id_kelompok = kp.id_kelompok
        LEFT JOIN tb_absensi a ON m.id_mahasiswa = a.id_mahasiswa AND a.id_kelompok = mk.id_kelompok
        LEFT JOIN tb_izin i ON m.id_mahasiswa = i.id_mahasiswa AND i.id_kelompok = mk.id_kelompok
        WHERE 
            kp.id_pembimbing = '$id_pembimbing' 
            AND (m.id_mahasiswa LIKE '%$cari%' OR m.nama LIKE '%$cari%')
        GROUP BY m.id_mahasiswa, m.nama
    ";

                                            // Query untuk absensi
                                            $sql_absensi = "
        SELECT a.*, m.nama 
        FROM tb_absensi a 
        JOIN tb_mahasiswa m ON a.id_mahasiswa = m.id_mahasiswa
        JOIN tb_mahasiswa_kelompok mk ON m.id_mahasiswa = mk.id_mahasiswa
        JOIN tb_kelompok_pembimbing kp ON mk.id_kelompok = kp.id_kelompok
        WHERE 
            kp.id_pembimbing = '$id_pembimbing'
            AND (m.id_mahasiswa LIKE '%$cari%' OR m.nama LIKE '%$cari%')
    ";

                                            // Query untuk izin
                                            $sql_izin = "
        SELECT i.*, m.nama 
        FROM tb_izin i
        JOIN tb_mahasiswa m ON i.id_mahasiswa = m.id_mahasiswa
        JOIN tb_mahasiswa_kelompok mk ON m.id_mahasiswa = mk.id_mahasiswa
        JOIN tb_kelompok_pembimbing kp ON mk.id_kelompok = kp.id_kelompok
        WHERE 
            kp.id_pembimbing = '$id_pembimbing'
            AND (m.id_mahasiswa LIKE '%$cari%' OR m.nama LIKE '%$cari%')
    ";

                                            // Eksekusi query
                                            $result_statistik = mysqli_query($koneksi, $sql_statistik);
                                            $result_absensi = mysqli_query($koneksi, $sql_absensi);
                                            $result_izin = mysqli_query($koneksi, $sql_izin);

                                            // Periksa apakah query berhasil
                                            if (!$result_statistik) {
                                                echo "Error statistik: " . mysqli_error($koneksi);
                                            }
                                            if (!$result_absensi) {
                                                echo "Error absensi: " . mysqli_error($koneksi);
                                            }
                                            if (!$result_izin) {
                                                echo "Error izin: " . mysqli_error($koneksi);
                                            }

                                            // Proses statistik
                                            if ($result_statistik && mysqli_num_rows($result_statistik) > 0) {
                                                while ($row_statistik = mysqli_fetch_assoc($result_statistik)) {
                                                    echo "<div class='card-body'>";
                                                    echo "<h5>{$row_statistik['id_mahasiswa']} {$row_statistik['nama']}</h5>";
                                                    echo "<p>";
                                                    echo "<strong>Total Hadir:</strong> {$row_statistik['total_hadir']} kali<br>";
                                                    echo "<strong>Total Izin:</strong> {$row_statistik['total_izin']} kali<br>";
                                                    echo "<strong>Total Sakit:</strong> {$row_statistik['total_sakit']} kali";
                                                    echo "</p>";
                                                    echo "</div>";
                                                }
                                            } else {
                                                echo "<div class='card-body'>Tidak ada data statistik ditemukan</div>";
                                            }

                                            // Proses absensi dan izin sesuaikan dengan struktur yang ada di kode Anda sebelumnya
                                        } else {
                                            echo "<div class='card-body'>Silakan masukkan kata kunci pencarian.</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Alert box for Nama Kelompok -->

                        <div class="row">
                            <div class="table-responsive table--no-card m-b-30">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nip</th>
                                            <th>Nama</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Lokasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['cari'])) {
                                            // Escape input untuk mencegah SQL Injection
                                            $cari = mysqli_real_escape_string($koneksi, $_POST['cari']);

                                            // Query untuk pencarian
                                            $sql = "SELECT * FROM tb_absensi a 
                JOIN tb_mahasiswa m ON a.id_mahasiswa = m.id_mahasiswa 
                WHERE a.id_mahasiswa LIKE '%$cari%'";
                                            $query = mysqli_query($koneksi, $sql);

                                            // Penanganan error query
                                            if (!$query) {
                                                die('Error: ' . mysqli_error($koneksi));
                                            }

                                            // Periksa jika data ditemukan
                                            if (mysqli_num_rows($query) > 0) {
                                                $no = 1;
                                                while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo htmlspecialchars($row['id_mahasiswa'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td><?php echo htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td><?php echo $row['tgl_masuk']; ?></td>
                                                        <td><?php echo $row['tgl_keluar']; ?></td>
                                                        <td><?php echo $row['jam_masuk']; ?></td>
                                                        <td><?php echo $row['jam_keluar']; ?></td>
                                                        <td>
                                                            <button class="btn btn-info btn-view-location" data-lat="<?php echo $row['lat']; ?>" data-long="<?php echo $row['long']; ?>">
                                                                Lihat Lokasi
                                                            </button>
                                                        </td>
                                                    </tr>
                                        <?php
                                                    $no++;
                                                }
                                            } else {
                                                // Pesan jika data tidak ditemukan
                                                echo '<tr><td colspan="4">Data tidak ditemukan.</td></tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="m-5"></div>
                        <?php
                        if (isset($_POST['cari'])) {
                            // Escape input untuk mencegah SQL Injection
                            $cari = mysqli_real_escape_string($koneksi, $_POST['cari']);

                            // Query untuk pencarian izin dengan join ke tabel mahasiswa
                            $sql_izin = "
        SELECT 
            i.id,
            i.id_mahasiswa,
            m.nama,
            i.keterangan,
            i.alasan,
            i.waktu
        FROM tb_izin i
        JOIN tb_mahasiswa m ON i.id_mahasiswa = m.id_mahasiswa
        JOIN tb_mahasiswa_kelompok mk ON m.id_mahasiswa = mk.id_mahasiswa
        JOIN tb_kelompok_pembimbing kp ON mk.id_kelompok = kp.id_kelompok
        WHERE kp.id_pembimbing = '$id_pembimbing'
          AND (m.id_mahasiswa LIKE '%$cari%' OR m.nama LIKE '%$cari%')
        ORDER BY i.waktu DESC
    ";

                            // Eksekusi query
                            $query_izin = mysqli_query($koneksi, $sql_izin);

                            // Periksa apakah query berhasil
                            if (!$query_izin) {
                                die('Error: ' . mysqli_error($koneksi));
                            }
                        ?>
                            <div class="row">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>STB</th>
                                                <th>Nama</th>
                                                <th>Keterangan</th>
                                                <th>Alasan</th>
                                                <th>Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1; // Nomor urut data
                                            if (mysqli_num_rows($query_izin) > 0) {
                                                while ($row_izin = mysqli_fetch_assoc($query_izin)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo htmlspecialchars($row_izin['id_mahasiswa'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td><?php echo htmlspecialchars($row_izin['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td><?php echo htmlspecialchars($row_izin['keterangan'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td><?php echo htmlspecialchars($row_izin['alasan'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                        <td><?php echo htmlspecialchars($row_izin['waktu'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data izin ditemukan</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
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