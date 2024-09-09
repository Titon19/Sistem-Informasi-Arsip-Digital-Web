<?php
include ('../koneksi.php');

if (isset($_GET['id'])) {
    $id_kegiatan = $_GET['id'];

    $sql = "DELETE FROM Kegiatan WHERE id_kegiatan = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id_kegiatan);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: kegiatan.php?pesan=hapus_berhasil");
            exit();
        } else {
            echo "Terjadi kesalahan saat menghapus data.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Terjadi kesalahan pada persiapan statement.";
    }
} else {
    echo "ID kegiatan tidak ditemukan.";
}

mysqli_close($koneksi);
?>