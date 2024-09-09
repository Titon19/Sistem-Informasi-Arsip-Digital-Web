<?php
include ('../koneksi.php');

if (isset($_GET['id'])) {
    $id_riwayat = $_GET['id'];

    $sql = "DELETE FROM riwayat WHERE riwayat_id = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id_riwayat);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: riwayat.php?pesan=hapus_berhasil");
            exit();
        } else {
            echo "Terjadi kesalahan saat menghapus data.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Terjadi kesalahan pada persiapan statement.";
    }
} else {
    echo "ID riwayat unduhan tidak ditemukan.";
}

mysqli_close($koneksi);
?>