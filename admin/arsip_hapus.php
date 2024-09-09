<?php
include '../koneksi.php';

// Pastikan $_GET['id'] aman sebelum digunakan
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil nama file lama yang akan dihapus
$lama = mysqli_query($koneksi, "SELECT * FROM arsip WHERE arsip_id='$id'");
$l = mysqli_fetch_assoc($lama);
$nama_file_lama = $l['arsip_file'];

// Hapus file fisik dari direktori
if ($nama_file_lama) {
    $file_path = "../arsip/" . $nama_file_lama;
    if (file_exists($file_path)) {
        unlink($file_path);
    } else {
        echo "File tidak ditemukan: $file_path";
    }
}

// Hapus data dari tabel arsip
mysqli_query($koneksi, "DELETE FROM arsip WHERE arsip_id='$id'");

// Redirect kembali ke halaman arsip.php setelah penghapusan
header("location: arsip.php");
exit();
?>