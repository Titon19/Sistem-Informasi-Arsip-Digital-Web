<?php
include ('/koneksi.php');


$id_kontrak = $_POST['id_kontrak'];
$cara_pembayaran = $_POST['cara_pembayaran'];
$tanggal_pembayaran = $_POST['tanggal_pembayaran'];
$jumlah_pembayaran = $_POST['jumlah_pembayaran'];

$sql = "INSERT INTO Pembayaran (id_kontrak, cara_pembayaran, tanggal_pembayaran, jumlah_pembayaran)
VALUES ('$id_kontrak', '$cara_pembayaran', '$tanggal_pembayaran', '$jumlah_pembayaran')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>