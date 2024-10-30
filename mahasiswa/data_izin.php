<?php
session_start(); // Mulai session
require_once("../koneksi.php");
error_reporting(0);

// Ambil id mahasiswa dari session
$id_mahasiswa = $_SESSION['idsi'];
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
                                <input class="au-input au-input--xl" type="text" name="search" value="Riwayat Izin" readonly="" />
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
                                <form action="dt_izin_sv.php" method="post">
                                    <div class="form-group">
                                        <table class="table table-borderless table-striped table-earning">
                                            <tbody>
                                                <tr>
                                                    <td>STB</td>
                                                    <td>
                                                        <input type="text" readonly="" class="form-control" name="id_mahasiswa" value="<?php echo $_SESSION['idsi']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>
                                                        <input type="text" readonly="" class="form-control" name="nama" value="<?php echo $_SESSION['namasi']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Keterangan</td>
                                                    <td>
                                                        <select name="alasan" class="form-control" required>
                                                            <option value="">Pilih keterangan</option>
                                                            <option value="Sakit">Sakit</option>
                                                            <option value="Izin">Izin</option>
                                                            <option value="Keperluan keluarga">Keperluan Keluarga</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Alasan</td>
                                                    <td>
                                                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Alasan izin..." required></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu</td>
                                                    <td>
                                                        <input type="text" class="form-control" value="<?php echo date('l, d-m-Y h:i:s a'); ?>" name="waktu" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="submit" name="simpan_izin" class="btn btn-primary">Ajukan Izin</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="table-responsive table--no-card m-b-30">

                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Mahasiswa</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Alasan</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    // Query untuk mengambil data dari tabel tb_izin berdasarkan id_mahasiswa dari session
                                    $sql = "SELECT * FROM tb_izin WHERE id_mahasiswa = '$id_mahasiswa'";
                                    $query = mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $row['id_mahasiswa']; ?></td>
                                                <td><?php echo $row['nama']; ?></td>
                                                <td><?php echo $row['keterangan']; ?></td>
                                                <td><?php echo $row['alasan']; ?></td>
                                                <td><?php echo $row['waktu']; ?></td>
                                            </tr>
                                        <?php
                                        $no++;
                                    }
                                        ?>
                                        </tbody>
                                </table>
                            </div>
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