<?php
require_once("../koneksi.php");
error_reporting(0);
session_start();
?>

<?php
include '../koneksi.php';
$id = $_GET['id_mahasiswa'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$id'");
while ($d = mysqli_fetch_array($data)) {


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
    <form action="proedit_mahasiswa.php" enctype="multipart/form-data" method="post">
      <div class="form-group">
        <table class="table table-borderless table-striped table-earning">
          <tbody>
            <tr>
              <td>Foto</td>
              <td>
                <?php if ($d['foto'] != '') : ?>
                  <img src="../images/<?php echo $d['foto']; ?>" width="400" height="200"/>
                <?php else : ?>
                  <p>Tidak ada gambar</p>
                <?php endif; ?>
                <input type="checkbox" name="ubahfoto" value="true"> Ceklis jika ingin mengubah foto!
                <br>
                <input type="file" name="inpfoto">
              </td>
            </tr>
            <tr>
              <td>STB</td>
              <td>
                <input type="text" class="form-control" readonly name="id_mahasiswa" value="<?php echo $d['id_mahasiswa']; ?>" size="25px" maxlength="25px">
              </td>
            </tr>
            <tr>
              <td>Username</td>
              <td>
                <input type="text" class="form-control" required name="username" value="<?php echo $d['username']; ?>" autocomplete="off">
              </td>
            </tr>
            <tr>
              <td>Nama</td>
              <td><input type="text" class="form-control" required name="nama" value="<?php echo $d['nama']; ?>" autocomplete="off"></td>
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
              <td><input type="reset" name="" value="Batal" class="btn btn-danger"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </form>
  </body>

  </html>

<?php } ?>