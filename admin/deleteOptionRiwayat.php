<?php
// Mengambil koneksi database
include ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['id'])) {
        $ids = $_POST['id'];
        foreach ($ids as $id) {
            $id = intval($id);
            $query = "DELETE FROM riwayat WHERE riwayat_id = $id";
            mysqli_query($koneksi, $query);
        }
    }
}

// Redirect kembali ke halaman arsip kegiatan
header('Location: riwayat.php');
?>