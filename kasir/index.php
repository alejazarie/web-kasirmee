<?php 

session_start();
include_once 'sesi.php';
$nama_app = " | Kasir";
$modul = (isset($_GET['m']))?$_GET['m']:"awal";

switch ($modul) {
	
	case 'awal': default: $judul="Beranda Kasir $nama_app"; include "awal.php"; break;
	case 'logistik': $judul="Menu User $nama_app"; include 'modul/barangMasuk/index.php';  break;
	case 'detail': $judul="Menu Produk $nama_app"; include 'modul/user/detail.php'; break;
	
	
}


 ?>