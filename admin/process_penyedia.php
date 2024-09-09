<?php
include ('/koneksi.php');


$nama_penyedia = $_POST['nama_penyedia'];
$alamat_penyedia = $_POST['alamat_penyedia'];
$npwp = $_POST['npwp'];
$bank = $_POST['bank'];
$no_rekening = $_POST['no_rekening'];
$nama_direktur = $_POST['nama_direktur'];

$sql = "INSERT INTO Penyedia (nama_penyedia, alamat_penyedia, npwp, bank, no_rekening, nama_direktur)
VALUES ('$nama_penyedia', '$alamat_penyedia', '$npwp', '$bank', '$no_rekening', '$nama_direktur')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>