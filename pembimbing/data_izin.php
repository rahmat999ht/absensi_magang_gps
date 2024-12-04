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


// Pagination
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman aktif
$page = max($page, 1); // Pastikan halaman minimal 1
$offset = ($page - 1) * $limit; // Hitung offset

// Query total data untuk pagination
$sql_count = "
    SELECT COUNT(*) AS total
    FROM tb_izin i
    JOIN tb_mahasiswa m ON i.id_mahasiswa = m.id_mahasiswa
    JOIN tb_mahasiswa_kelompok mk ON mk.id_mahasiswa = m.id_mahasiswa
    JOIN tb_kelompok_pembimbing kp ON kp.id_kelompok = mk.id_kelompok
    JOIN tb_pembimbing p ON kp.id_pembimbing = p.id
    WHERE p.id = '$id_pembimbing'
";
$result_count = mysqli_query($koneksi, $sql_count);
$total_data = mysqli_fetch_assoc($result_count)['total'];
$total_pages = ceil($total_data / $limit);

// Query data izin dengan pagination
$sql_izin = "
    SELECT i.*, m.nama, m.id_mahasiswa
    FROM tb_izin i
    JOIN tb_mahasiswa m ON i.id_mahasiswa = m.id_mahasiswa
    JOIN tb_mahasiswa_kelompok mk ON mk.id_mahasiswa = m.id_mahasiswa
    JOIN tb_kelompok_pembimbing kp ON kp.id_kelompok = mk.id_kelompok
    JOIN tb_pembimbing p ON kp.id_pembimbing = p.id
    WHERE p.id = '$id_pembimbing'
    LIMIT $limit OFFSET $offset
";
$query_izin = mysqli_query($koneksi, $sql_izin);

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
                        <!-- Card for total izin per mahasiswa -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Total Izin per Mahasiswa</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        // Query to count the total izin per mahasiswa
                                        $sql_izin_count = "
                SELECT 
                    m.id_mahasiswa,
                    m.nama,
                    COUNT(DISTINCT i.id) AS total_izin
                FROM tb_izin i
                JOIN tb_mahasiswa m ON i.id_mahasiswa = m.id_mahasiswa
                JOIN tb_mahasiswa_kelompok mk ON mk.id_mahasiswa = m.id_mahasiswa
                JOIN tb_kelompok_pembimbing kp ON kp.id_kelompok = mk.id_kelompok
                JOIN tb_pembimbing p ON kp.id_pembimbing = p.id
                WHERE p.id = '$id_pembimbing'
                GROUP BY m.id_mahasiswa
                ";

                                        // Execute the query to get the count of izin per mahasiswa
                                        $result_izin_count = mysqli_query($koneksi, $sql_izin_count);

                                        // Fetch and display the total izin for each mahasiswa
                                        while ($row_izin_count = mysqli_fetch_array($result_izin_count)) {
                                        ?>
                                            <p><?php echo $row_izin_count['id_mahasiswa']; ?> <?php echo $row_izin_count['nama']; ?> memiliki total izin: <strong><?php echo $row_izin_count['total_izin']; ?></strong></p>
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
                                            <th>Keterangan</th>
                                            <th>Alasan</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = $offset + 1; // Nomor urut data
                                        while ($row_izin = mysqli_fetch_assoc($query_izin)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row_izin['id_mahasiswa']; ?></td>
                                                <td><?php echo $row_izin['nama']; ?></td>
                                                <td><?php echo $row_izin['keterangan']; ?></td>
                                                <td><?php echo $row_izin['alasan']; ?></td>
                                                <td><?php echo $row_izin['waktu']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Pagination -->
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link"
                                    <?php if ($page > 1) {
                                        $Previous = $page - 1;
                                        echo "href='?page=$Previous'";
                                    } ?>>Previous</a>
                            </li>
                            <?php
                            for ($x = 1; $x <= $total_pages; $x++) {
                            ?>
                                <li class="page-item <?php if ($x == $page) echo 'active'; ?>">
                                    <a class="page-link" href="?page=<?php echo $x ?>"><?php echo $x; ?></a>
                                </li>
                            <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link"
                                    <?php if ($page < $total_pages) {
                                        $next = $page + 1;
                                        echo "href='?page=$next'";
                                    } ?>>Next</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>

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