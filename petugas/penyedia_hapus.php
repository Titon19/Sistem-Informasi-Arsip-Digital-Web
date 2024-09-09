<?php
include ('../koneksi.php');

if (isset($_GET['id'])) {
    $id_penyedia = $_GET['id'];

    $sql = "DELETE FROM Penyedia WHERE id_penyedia = ?";

    if ($stmt = mysqli_prepare($koneksi, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id_penyedia);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: penyedia.php?pesan=hapus_berhasil");
            exit();
        } else {
            echo "Terjadi kesalahan saat menghapus data.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Terjadi kesalahan pada persiapan statement.";
    }
} else {
    echo "ID penyedia tidak ditemukan.";
}

mysqli_close($koneksi);
?>