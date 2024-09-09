<?php
include ('../koneksi.php');

if (isset($_GET['id'])) {
    $id_riwayat_preview = $_GET['id'];

    $sql = "DELETE FROM riwayat_preview WHERE riwayat_preview_id = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id_riwayat_preview);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: riwayat_preview.php?pesan=hapus_berhasil");
            exit();
        } else {
            echo "Terjadi kesalahan saat menghapus data.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Terjadi kesalahan pada persiapan statement.";
    }
} else {
    echo "ID riwayat preview tidak ditemukan.";
}

mysqli_close($koneksi);
?>