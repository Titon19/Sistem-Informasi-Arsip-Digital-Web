<?php
// Mengambil koneksi database
include ('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['id'])) {
        $ids = $_POST['id'];
        foreach ($ids as $id) {
            $id = intval($id);
            $query = "DELETE FROM riwayat_preview WHERE riwayat_preview_id = $id";
            mysqli_query($koneksi, $query);
        }
    }
}

// Redirect kembali ke halaman arsip kegiatan
header('Location: riwayat_preview.php');
?>