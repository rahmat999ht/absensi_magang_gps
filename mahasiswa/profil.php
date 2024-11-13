<?php
require_once("../koneksi.php");
error_reporting(0);
session_start();

$id_mahasiswa = $_SESSION['idsi'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$id_mahasiswa'");
$d = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>

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
  <title>Edit data mahasiswa</title>

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

  <title>Ubah Data Mahasiswa</title>
</head>

<body>
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
                <input class="au-input au-input--xl" type="text" name="search" value="Profil Mahasiswa" readonly="" />
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
                <form action="proedit_profil.php" enctype="multipart/form-data" method="post">
                  <div class="form-group">
                    <table class="table table-borderless table-striped table-earning">
                      <tbody>
                        <tr>
                          <td>Foto</td>
                          <td>
                            <?php if ($d['foto'] != '') : ?>
                              <img src="../images/<?php echo $d['foto']; ?>" width="200" height="150" />
                            <?php else : ?>
                              <p>Tidak ada gambar</p>
                            <?php endif; ?>
                            <input type="checkbox" name="ubahfoto" value="true"> Ceklis jika ingin mengubah foto!
                            <br>
                            <input type="file" name="inpfoto">
                          </td>
                        </tr>
                        <tr>
                          <td>Username</td>
                          <td>
                            <input type="text" class="form-control" required name="username" value="<?php echo $d['username']; ?>" autocomplete="off">
                          </td>
                        </tr>
                        <tr>
                          <td>Password</td>
                          <td>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan password baru" autocomplete="off">
                          </td>
                        </tr>
                        <tr>
                          <td>STB</td>
                          <td>
                            <input type="text" class="form-control" readonly name="id_mahasiswa" value="<?php echo $d['id_mahasiswa']; ?>">
                          </td>
                        </tr>
                        <tr>
                          <td>Nama</td>
                          <td><input type="text" class="form-control" readonly name="nama" value="<?php echo $d['nama']; ?>" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>Tempat dan Tanggal Lahir</td>
                          <td><input type="text" class="form-control" required name="tmp_tgl_lahir" value="<?php echo $d['tmp_tgl_lahir']; ?>" autocomplete="off"></td>
                        </tr>
                        <tr>
                          <td>Jenis Kelamin</td>
                          <td>
                            <select class="form-control" required name="jenkel">
                              <option selected><?php echo $d['jenkel']; ?></option>
                              <option value="Laki-laki">Laki-laki</option>
                              <option value="Perempuan">Perempuan</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>Agama</td>
                          <td>
                            <select class="form-control" required name="agama">
                              <option selected><?php echo $d['agama']; ?></option>
                              <option>Islam</option>
                              <option>Kristen</option>
                              <option>Katholik</option>
                              <option>Hindu</option>
                              <option>Buddha</option>
                              <option>KongHuCu</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>Alamat</td>
                          <td><textarea class="form-control" required name="alamat" autocomplete="off"><?php echo $d['alamat']; ?></textarea></td>
                        </tr>
                        <tr>
                          <td>No Telepon</td>
                          <td><input type="text" class="form-control" required name="no_tel" value="<?php echo $d['no_tel']; ?>" autocomplete="off" maxlength="18"></td>
                        </tr>
                        <tr>
                          <td><button type="submit" name="ubahdata" class="btn btn-primary">Simpan</button></td>
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
    </div>
  </div>
</body>

</html>