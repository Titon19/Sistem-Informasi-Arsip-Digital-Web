<?php
include ('/koneksi.php');


$id_sub_kegiatan = $_POST['id_sub_kegiatan'];
$id_penyedia = $_POST['id_penyedia'];
$no_kontrak = $_POST['no_kontrak'];
$tanggal_kontrak = $_POST['tanggal_kontrak'];
$nilai_realisasi = $_POST['nilai_realisasi'];
$no_spp = $_POST['no_spp'];
$tanggal_spp = $_POST['tanggal_spp'];
$no_spm = $_POST['no_spm'];
$tanggal_spm = $_POST['tanggal_spm'];
$keterangan_kontrak = $_POST['keterangan_kontrak'];

$sql = "INSERT INTO Kontrak (id_sub_kegiatan, id_penyedia, no_kontrak, tanggal_kontrak, nilai_realisasi, no_spp, tanggal_spp, no_spm, tanggal_spm, keterangan)
VALUES ('$id_sub_kegiatan', '$id_penyedia', '$no_kontrak', '$tanggal_kontrak', '$nilai_realisasi', '$no_spp', '$tanggal_spp', '$no_spm', '$tanggal_spm', '$keterangan_kontrak')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>