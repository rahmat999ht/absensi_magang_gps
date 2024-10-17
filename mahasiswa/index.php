<?php
session_start();
include_once "sesi_mahasiswa.php";
$modul=(isset($_GET['m']))?$_GET['m']:"awal";
$jawal="Login karyawan || SI karyawan";
switch($modul){
    case 'awal': default: $aktif="Beranda"; $judul="Beranda $jawal"; include "awal.php"; break;
    case 'karyawan': $aktif="karyawan"; $judul="Modul karyawan $jawal"; include "modul/karyawan/index.php"; break;   
}

?>
