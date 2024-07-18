<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'kasir_zibran');

// Pastikan id yang diterima dari URL aman untuk digunakan
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lakukan penghapusan data dari tabel transaksi_temp
$delete = mysqli_query($koneksi, "DELETE FROM transaksi_temp WHERE id = $id");

// Periksa jika penghapusan berhasil
if ($delete) {
    // Redirect kembali ke halaman sebelumnya menggunakan JavaScript
    echo '<script>window.history.back()</script>';
} else {
    // Tambahkan penanganan jika penghapusan gagal (opsional)
    echo 'Penghapusan gagal. Silakan coba lagi.';
}
?>
