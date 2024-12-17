<?php
error_reporting(0);
require_once("../koneksi.php");
session_start();
$id_pembimbing = $_SESSION['id_pembimbing'];  // Asumsi id_pembimbing disimpan di session setelah login

// Ambil nama kelompok untuk pembimbing yang sedang login
$sql_kelompok = "
    SELECT k.id_kelompok, k.nama_kelompok
    FROM tb_kelompok k
    JOIN tb_kelompok_pembimbing kp ON k.id_kelompok = kp.id_kelompok
    WHERE kp.id_pembimbing = '$id_pembimbing'
";

$query_kelompok = mysqli_query($koneksi, $sql_kelompok);
$kelompok = mysqli_fetch_assoc($query_kelompok);

// Pagination
$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

// Query untuk total data berdasarkan kelompok
$total_data_query = "
    SELECT COUNT(*) AS total
    FROM tb_dokumentasi d
    JOIN tb_mahasiswa_kelompok mk ON d.id_mahasiswa = mk.id_mahasiswa
    WHERE mk.id_kelompok = '{$kelompok['id_kelompok']}'
";

$total_data_result = mysqli_query($koneksi, $total_data_query);
$total_data_row = mysqli_fetch_assoc($total_data_result);
$total_data = $total_data_row['total'];

$total_halaman = ceil($total_data / $batas);

// Query data mahasiswa dalam kelompok tertentu dengan limit
$data_query = "
    SELECT d.id, d.id_mahasiswa, m.nama, d.asal_kampus, d.bidang_penempatan, d.nama_kegiatan, d.waktu
    FROM tb_dokumentasi d
    JOIN tb_mahasiswa m ON d.id_mahasiswa = m.id_mahasiswa
    JOIN tb_mahasiswa_kelompok mk ON d.id_mahasiswa = mk.id_mahasiswa
    WHERE mk.id_kelompok = '{$kelompok['id_kelompok']}'
    LIMIT $halaman_awal, $batas
";
$data_result = mysqli_query($koneksi, $data_query);


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
    <title>Data Keterangan</title>

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

                            <!-- <form class="form-header" action="prospenkar.php" method="POST">
                                <input class="au-input au-input--xl" autocomplete="off" type="text" name="cari" placeholder="Cari ID atau nama mahasiswa" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">

                            </div> -->
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
                        <!-- Card for total dokumentasi per mahasiswa -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Total Dokumentasi per Mahasiswa</h4>
                                    </div>
                                    <div class="card-body">

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

                                        // Count total dokumentasi per mahasiswa
                                        $result = mysqli_query($koneksi, $sql);

                                        // Fetch and display data for each mahasiswa
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                            <p><?php echo $row['id_mahasiswa']; ?> <?php echo $row['nama']; ?> adalah: <strong><?php echo $row['total_dokumentasi']; ?></strong></p>
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
                                            <th>Asal Kampus</th>
                                            <th>Bidang Penempatan</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Waktu</th>
                                            <!-- <th>Aksi</th> -->
                                        </tr>
                                    </thead>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <tbody>
                                        <?php
                                        $nomor = $halaman_awal + 1;
                                        if (mysqli_num_rows($data_result) > 0) {
                                            while ($row = mysqli_fetch_assoc($data_result)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $nomor++; ?></td>
                                                    <td><?php echo $row['id_mahasiswa']; ?></td>
                                                    <td><?php echo $row['nama']; ?></td>
                                                    <td><?php echo $row['asal_kampus']; ?></td>
                                                    <td><?php echo $row['bidang_penempatan']; ?></td>
                                                    <td><?php echo $row['nama_kegiatan']; ?></td>
                                                    <td><?php echo $row['waktu']; ?></td>
                                                    <!-- <td>
                                                        <a href="hapus_dokumentasi.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?');">Hapus</a>
                                                    </td> -->
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data dokumentasi ditemukan.</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <!-- HTML Pagination -->
                        <!-- <nav> -->
                        <ul class="pagination justify-content-center">
                            <?php if ($halaman > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?halaman=<?= $previous; ?>">Previous</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                                <li class="page-item <?= $i == $halaman ? 'active' : ''; ?>">
                                    <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($halaman < $total_halaman): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?halaman=<?= $next; ?>">Next</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <!-- </nav> -->
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