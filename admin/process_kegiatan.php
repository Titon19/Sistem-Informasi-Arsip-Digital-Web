<?php
include ('/koneksi.php');


$kode_kegiatan = $_POST['kode_kegiatan'];
$nama_kegiatan = $_POST['nama_kegiatan'];
$tanggal_mulai = $_POST['tanggal_mulai'];
$tanggal_selesai = $_POST['tanggal_selesai'];
$keterangan_kegiatan = $_POST['keterangan_kegiatan'];

$sql = "INSERT INTO Kegiatan (kode_kegiatan, nama_kegiatan, tanggal_mulai, tanggal_selesai, keterangan)
VALUES ('$kode_kegiatan', '$nama_kegiatan', '$tanggal_mulai', '$tanggal_selesai', '$keterangan_kegiatan')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>