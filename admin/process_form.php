<?php


include ('\koneksi.php');

// Capture form data
$kode_kegiatan = $_POST['kode_kegiatan'];
$nama_kegiatan = $_POST['nama_kegiatan'];
$tanggal_mulai = $_POST['tanggal_mulai'];
$tanggal_selesai = $_POST['tanggal_selesai'];
$keterangan_kegiatan = $_POST['keterangan_kegiatan'];

$id_kegiatan = $_POST['id_kegiatan'];
$nama_sub_kegiatan = $_POST['nama_sub_kegiatan'];
$nilai_kontrak = $_POST['nilai_kontrak'];
$tanggal_mulai_sub = $_POST['tanggal_mulai_sub'];
$tanggal_selesai_sub = $_POST['tanggal_selesai_sub'];
$keterangan_sub = $_POST['keterangan_sub'];

$nama_penyedia = $_POST['nama_penyedia'];
$alamat_penyedia = $_POST['alamat_penyedia'];
$npwp = $_POST['npwp'];
$bank = $_POST['bank'];
$no_rekening = $_POST['no_rekening'];
$nama_direktur = $_POST['nama_direktur'];

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

$id_kontrak = $_POST['id_kontrak'];
$cara_pembayaran = $_POST['cara_pembayaran'];
$tanggal_pembayaran = $_POST['tanggal_pembayaran'];
$jumlah_pembayaran = $_POST['jumlah_pembayaran'];

// Insert data into Kegiatan table
$sql_kegiatan = "INSERT INTO Kegiatan (kode_kegiatan, nama_kegiatan, tanggal_mulai, tanggal_selesai, keterangan)
VALUES ('$kode_kegiatan', '$nama_kegiatan', '$tanggal_mulai', '$tanggal_selesai', '$keterangan_kegiatan')";

if ($koneksi->query($sql_kegiatan) === TRUE) {
    echo "New record created successfully in Kegiatan table";
} else {
    echo "Error: " . $sql_kegiatan . "<br>" . $koneksi->error;
}

// Insert data into Sub_Kegiatan table
$sql_sub_kegiatan = "INSERT INTO Sub_Kegiatan (id_kegiatan, nama_sub_kegiatan, nilai_kontrak, tanggal_mulai, tanggal_selesai, keterangan)
VALUES ('$id_kegiatan', '$nama_sub_kegiatan', '$nilai_kontrak', '$tanggal_mulai_sub', '$tanggal_selesai_sub', '$keterangan_sub')";

if ($koneksi->query($sql_sub_kegiatan) === TRUE) {
    echo "New record created successfully in Sub_Kegiatan table";
} else {
    echo "Error: " . $sql_sub_kegiatan . "<br>" . $koneksi->error;
}

// Insert data into Penyedia table
$sql_penyedia = "INSERT INTO Penyedia (nama_penyedia, alamat_penyedia, npwp, bank, no_rekening, nama_direktur)
VALUES ('$nama_penyedia', '$alamat_penyedia', '$npwp', '$bank', '$no_rekening', '$nama_direktur')";

if ($koneksi->query($sql_penyedia) === TRUE) {
    echo "New record created successfully in Penyedia table";
} else {
    echo "Error: " . $sql_penyedia . "<br>" . $koneksi->error;
}

// Insert data into Kontrak table
$sql_kontrak = "INSERT INTO Kontrak (id_sub_kegiatan, id_penyedia, no_kontrak, tanggal_kontrak, nilai_realisasi, no_spp, tanggal_spp, no_spm, tanggal_spm, keterangan)
VALUES ('$id_sub_kegiatan', '$id_penyedia', '$no_kontrak', '$tanggal_kontrak', '$nilai_realisasi', '$no_spp', '$tanggal_spp', '$no_spm', '$tanggal_spm', '$keterangan_kontrak')";

if ($koneksi->query($sql_kontrak) === TRUE) {
    echo "New record created successfully in Kontrak table";
} else {
    echo "Error: " . $sql_kontrak . "<br>" . $koneksi->error;
}

// Insert data into Pembayaran table
$sql_pembayaran = "INSERT INTO Pembayaran (id_kontrak, cara_pembayaran, tanggal_pembayaran, jumlah_pembayaran)
VALUES ('$id_kontrak', '$cara_pembayaran', '$tanggal_pembayaran', '$jumlah_pembayaran')";

if ($koneksi->query($sql_pembayaran) === TRUE) {
    echo "New record created successfully in Pembayaran table";
} else {
    echo "Error: " . $sql_pembayaran . "<br>" . $koneksi->error;
}

$koneksi->close();
?>