<?php
session_start(); // Mulai session
include '../koneksi.php';
$id_pembimbing = $_SESSION['id_pembimbing'];  // Asumsi id_pembimbing disimpan di session setelah login

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
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Beranda</title>

    <!-- Fontfaces CSS-->
    <link href="../css/font-face.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- ../Vendor CSS-->
    <link href="../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">

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

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <h1>Absensi Magang </h1>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

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
                        <div class="row">
                            <table class='table table-borderless table-striped table-earning'>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>STB</th>
                                        <th>Total Absen</th>
                                        <th>Total Izin</th>
                                        <th>Total Sakit</th>
                                        <th>Total Keperluan Keluarga</th>
                                        <th>Total Dokumentasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "
        SELECT 
            m.id_mahasiswa,
            m.nama,
            COUNT(DISTINCT a.id) AS total_absen,
            COUNT(DISTINCT i.id) AS total_izin,
            COUNT(DISTINCT CASE WHEN i.keterangan = 'Sakit' THEN i.id END) AS total_izin_sakit,
            COUNT(DISTINCT CASE WHEN i.keterangan = 'Keperluan Keluarga' THEN i.id END) AS total_izin_keperluan_keluarga,
            COUNT(DISTINCT d.id) AS total_dokumentasi
        FROM tb_mahasiswa m
        LEFT JOIN tb_absensi a ON m.id_mahasiswa = a.id_mahasiswa
        LEFT JOIN tb_izin i ON m.id_mahasiswa = i.id_mahasiswa
        LEFT JOIN tb_dokumentasi d ON m.id_mahasiswa = d.id_mahasiswa
        LEFT JOIN tb_kelompok_pembimbing kp ON kp.id_kelompok = a.id_kelompok
        WHERE kp.id_pembimbing = '$id_pembimbing'
        GROUP BY m.id_mahasiswa
        ";

                                    $query = mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $row['id_mahasiswa']; ?></td>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><?php echo $row['total_absen']; ?></td>
                                            <td><?php echo $row['total_izin']; ?></td>
                                            <td><?php echo $row['total_izin_sakit']; ?></td>
                                            <td><?php echo $row['total_izin_keperluan_keluarga']; ?></td>
                                            <td><?php echo $row['total_dokumentasi']; ?></td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                        <div class="row">
                            <strong class="col-md-12" style="margin-top: 5rem;">Selamat datang pembimbing magang</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="../vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- ../Vendor JS       -->
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