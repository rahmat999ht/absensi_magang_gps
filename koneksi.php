<?php 
$koneksi = mysqli_connect("localhost", "root", "", "magang");

if (mysqli_connect_errno()) {
	echo "koneksi gagal " . mysql_connect_error();
}
 ?>